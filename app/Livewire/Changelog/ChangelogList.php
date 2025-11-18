<?php

namespace App\Livewire\Changelog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Changelog;
use App\Models\ChangelogCategory;
use Illuminate\Support\Facades\Auth;

class ChangelogList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCategory = '';
    public $filterStatus = '';
    public $showFilters = false;

    protected $queryString = ['search', 'filterCategory', 'filterStatus'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filterCategory = '';
        $this->filterStatus = '';
        $this->showFilters = false;
        $this->resetPage();
    }

    public function deleteChangelog($changelogId)
    {
        $changelog = Changelog::where('workspace_id', Auth::user()->workspace_id)
            ->findOrFail($changelogId);

        // Delete cover image if exists
        if ($changelog->cover_image) {
            \Storage::disk('public')->delete($changelog->cover_image);
        }

        $changelog->delete();

        session()->flash('success', 'Changelog deleted successfully.');
    }

    public function render()
    {
        $workspaceId = Auth::user()->workspace_id;

        $query = Changelog::where('workspace_id', $workspaceId)
            ->with(['category', 'tags']);

        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('short_description', 'like', '%' . $this->search . '%')
                  ->orWhere('author_name', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->filterCategory) {
            $query->where('changelog_category_id', $this->filterCategory);
        }

        // Apply status filter
        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $changelogs = $query->latest('published_at')->paginate(10);

        $categories = ChangelogCategory::where('workspace_id', $workspaceId)
            ->where('is_active', true)
            ->get();

        return view('livewire.changelog.changelog-list', [
            'changelogs' => $changelogs,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
