<?php

namespace App\Livewire\Changelog;

use Livewire\Component;
use App\Models\Changelog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChangelogView extends Component
{
    public $changelogId;
    public $changelog;

    public function mount($id)
    {
        $this->changelogId = $id;

        $this->changelog = Changelog::where('workspace_id', Auth::user()->workspace_id)
            ->with(['category', 'tags'])
            ->findOrFail($id);
    }

    public function deleteChangelog()
    {
        // Delete cover image if exists
        if ($this->changelog->cover_image) {
            Storage::disk('public')->delete($this->changelog->cover_image);
        }

        $this->changelog->delete();

        session()->flash('success', 'Changelog deleted successfully.');

        return redirect()->route('changelog.index');
    }

    public function render()
    {
        return view('livewire.changelog.changelog-view')->layout('layouts.app');
    }
}
