<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\ChangelogCategory;
use Illuminate\Support\Facades\Auth;

class Changelog extends Component
{
    public $name = '';
    public $color_code = '';
    public $is_active = true;
    public $editingCategoryId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'color_code' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        'is_active' => 'boolean',
    ];

    protected $messages = [
        'name.required' => 'Category name is required.',
        'color_code.required' => 'Color code is required.',
        'color_code.regex' => 'Color code must be a valid hex color (e.g., #FF5733).',
    ];

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $workspaceId = Auth::user()->workspace_id;

        ChangelogCategory::create([
            'workspace_id' => $workspaceId,
            'name' => $this->name,
            'color_code' => ChangelogCategory::generateRandomColor(),
            'is_active' => $this->is_active,
        ]);

        $this->reset(['name', 'is_active']);
        $this->is_active = true;

        session()->flash('success', 'Category added successfully.');
    }

    public function editCategory($categoryId)
    {
        $category = ChangelogCategory::where('workspace_id', Auth::user()->workspace_id)
            ->findOrFail($categoryId);

        $this->editingCategoryId = $category->id;
        $this->name = $category->name;
        $this->color_code = $category->color_code;
        $this->is_active = $category->is_active;
    }

    public function updateCategory()
    {
        $this->validate();

        $category = ChangelogCategory::where('workspace_id', Auth::user()->workspace_id)
            ->findOrFail($this->editingCategoryId);

        $category->update([
            'name' => $this->name,
            'color_code' => $this->color_code,
            'is_active' => $this->is_active,
        ]);

        $this->closeEditModal();

        session()->flash('success', 'Category updated successfully.');
    }

    public function deleteCategory($categoryId)
    {
        $category = ChangelogCategory::where('workspace_id', Auth::user()->workspace_id)
            ->findOrFail($categoryId);

        $category->delete();

        session()->flash('success', 'Category deleted successfully.');
    }

    public function closeEditModal()
    {
        $this->reset(['editingCategoryId', 'name', 'color_code', 'is_active']);
        $this->is_active = true;
        $this->resetValidation();
    }

    public function render()
    {
        $categories = ChangelogCategory::where('workspace_id', Auth::user()->workspace_id)
            ->latest()
            ->get();

        return view('livewire.settings.changelog', [
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
