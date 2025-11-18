<?php

namespace App\Livewire\Changelog;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Changelog;
use App\Models\ChangelogCategory;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ChangelogForm extends Component
{
    use WithFileUploads;

    public $changelogId = null;
    public $title = '';
    public $cover_image;
    public $existing_cover_image = null;
    public $short_description = '';
    public $description = '';
    public $changelog_category_id = '';
    public $tags_input = '';
    public $selected_tags = [];
    public $author_name = '';
    public $published_at = '';
    public $status = 'draft';

    // For tag autocomplete
    public $tag_suggestions = [];
    public $show_tag_suggestions = false;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'short_description' => 'required|string|min:200|max:200',
            'description' => 'required|string|min:10',
            'changelog_category_id' => 'nullable|exists:changelog_categories,id',
            'author_name' => 'required|string|max:255',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published,scheduled',
        ];
    }

    protected $messages = [
        'short_description.min' => 'Short description must be at least 200 characters.',
        'short_description.max' => 'Short description must not exceed 200 characters.',
        'description.min' => 'Description must be at least 10 characters.',
    ];

    public function mount($id = null)
    {
        $this->changelogId = $id;

        // Set default values
        $this->author_name = Auth::user()->name;
        $this->published_at = Carbon::now()->format('Y-m-d\TH:i');

        if ($id) {
            $changelog = Changelog::where('workspace_id', Auth::user()->workspace_id)
                ->with('tags')
                ->findOrFail($id);

            $this->title = $changelog->title;
            $this->existing_cover_image = $changelog->cover_image;
            $this->short_description = $changelog->short_description;
            $this->description = $changelog->description;
            $this->changelog_category_id = $changelog->changelog_category_id;
            $this->author_name = $changelog->author_name;
            $this->published_at = $changelog->published_at->format('Y-m-d\TH:i');
            $this->status = $changelog->status;

            // Load tags
            $this->selected_tags = $changelog->tags->pluck('name')->toArray();
        }

        $this->updateStatusBasedOnDate();
    }

    public function updatedPublishedAt()
    {
        $this->updateStatusBasedOnDate();
    }

    public function updateStatusBasedOnDate()
    {
        if ($this->published_at) {
            $publishedDate = Carbon::parse($this->published_at);
            $now = Carbon::now();

            if ($publishedDate->isFuture() && $this->status !== 'draft') {
                $this->status = 'scheduled';
            }
        }
    }

    public function updatedTagsInput()
    {
        if (strlen($this->tags_input) >= 1) {
            $workspaceId = Auth::user()->workspace_id;
            $this->tag_suggestions = Tag::where('workspace_id', $workspaceId)
                ->where('name', 'like', '%' . $this->tags_input . '%')
                ->limit(5)
                ->pluck('name')
                ->toArray();
            $this->show_tag_suggestions = count($this->tag_suggestions) > 0;
        } else {
            $this->tag_suggestions = [];
            $this->show_tag_suggestions = false;
        }
    }

    public function addTag($tagName = null)
    {
        $tag = $tagName ?? $this->tags_input;

        if (empty($tag)) {
            return;
        }

        // Trim and check if already exists
        $tag = trim($tag);

        if (!in_array($tag, $this->selected_tags)) {
            $this->selected_tags[] = $tag;
        }

        $this->tags_input = '';
        $this->tag_suggestions = [];
        $this->show_tag_suggestions = false;
    }

    public function removeTag($index)
    {
        unset($this->selected_tags[$index]);
        $this->selected_tags = array_values($this->selected_tags);
    }

    public function save()
    {
        $this->validate();

        $workspaceId = Auth::user()->workspace_id;

        // Handle cover image upload
        $coverImagePath = $this->existing_cover_image;
        if ($this->cover_image) {
            // Delete old image if exists
            if ($this->existing_cover_image) {
                Storage::disk('public')->delete($this->existing_cover_image);
            }
            $coverImagePath = $this->cover_image->store('changelogs', 'public');
        }

        // Generate slug
        $slug = Changelog::generateSlug($this->title, $this->changelogId);

        $changelogData = [
            'workspace_id' => $workspaceId,
            'changelog_category_id' => $this->changelog_category_id ?: null,
            'title' => $this->title,
            'slug' => $slug,
            'cover_image' => $coverImagePath,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'author_name' => $this->author_name,
            'published_at' => Carbon::parse($this->published_at),
            'status' => $this->status,
        ];

        if ($this->changelogId) {
            // Update existing changelog
            $changelog = Changelog::where('workspace_id', $workspaceId)
                ->findOrFail($this->changelogId);
            $changelog->update($changelogData);
            $message = 'Changelog updated successfully.';
        } else {
            // Create new changelog
            $changelog = Changelog::create($changelogData);
            $message = 'Changelog created successfully.';
        }

        // Sync tags
        $tagIds = [];
        foreach ($this->selected_tags as $tagName) {
            $tag = Tag::findOrCreateByName($workspaceId, $tagName);
            $tagIds[] = $tag->id;
        }
        $changelog->tags()->sync($tagIds);

        session()->flash('success', $message);

        return redirect()->route('changelog.index');
    }

    public function cancel()
    {
        return redirect()->route('changelog.index');
    }

    public function render()
    {
        $categories = ChangelogCategory::where('workspace_id', Auth::user()->workspace_id)
            ->where('is_active', true)
            ->get();

        return view('livewire.changelog.changelog-form', [
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
