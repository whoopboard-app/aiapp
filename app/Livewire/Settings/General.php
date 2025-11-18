<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkspaceBranding;
use App\Models\WorkspaceNavigationItem;

class General extends Component
{
    use WithFileUploads;

    // Branding properties
    public $displayName;
    public $companyName;
    public $logoLinkUrl;
    public $defaultLogoLayout = 'square';

    // File uploads (temporary)
    public $logoLight;
    public $favicon;
    public $logoSquare;
    public $logoLandscape;

    // Existing file paths
    public $existingLogoLight;
    public $existingFavicon;
    public $existingLogoSquare;
    public $existingLogoLandscape;

    // Navigation items
    public $navigationItems = [];
    public $editingItemId = null;
    public $editingLabel = '';

    protected $rules = [
        'displayName' => 'nullable|string|max:255',
        'companyName' => 'nullable|string|max:255',
        'logoLinkUrl' => 'nullable|url|max:255',
        'defaultLogoLayout' => 'required|in:square,landscape',
        'logoLight' => 'nullable|image|max:2048',
        'favicon' => 'nullable|image|mimes:png|max:1024',
        'logoSquare' => 'nullable|image|max:2048',
        'logoLandscape' => 'nullable|image|max:2048',
        'navigationItems.*.label' => 'required|string|min:1|max:255',
    ];

    public function mount()
    {
        $workspace = Auth::user()->workspace;

        // Load or create branding
        $branding = WorkspaceBranding::firstOrCreate(
            ['workspace_id' => $workspace->id],
            [
                'display_name' => $workspace->name,
                'company_name' => $workspace->company_name,
                'default_logo_layout' => 'square',
            ]
        );

        $this->displayName = $branding->display_name;
        $this->companyName = $branding->company_name;
        $this->logoLinkUrl = $branding->logo_link_url;
        $this->defaultLogoLayout = $branding->default_logo_layout;

        $this->existingLogoLight = $branding->logo_light_path;
        $this->existingFavicon = $branding->favicon_path;
        $this->existingLogoSquare = $branding->logo_square_path;
        $this->existingLogoLandscape = $branding->logo_landscape_path;

        // Load or create navigation items
        $this->loadNavigationItems();
    }

    protected function loadNavigationItems()
    {
        $workspace = Auth::user()->workspace;

        // Check if navigation items exist for this workspace
        $existingItems = WorkspaceNavigationItem::where('workspace_id', $workspace->id)->count();

        if ($existingItems === 0) {
            // Create default items
            foreach (WorkspaceNavigationItem::getDefaultItems() as $item) {
                WorkspaceNavigationItem::create([
                    'workspace_id' => $workspace->id,
                    'key' => $item['key'],
                    'label' => $item['label'],
                    'is_active' => true,
                    'sort_order' => $item['sort_order'],
                ]);
            }
        }

        // Load items
        $this->navigationItems = WorkspaceNavigationItem::where('workspace_id', $workspace->id)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    public function updateBranding()
    {
        $this->validate();

        $workspace = Auth::user()->workspace;
        $branding = WorkspaceBranding::firstOrNew(['workspace_id' => $workspace->id]);

        // Handle file uploads
        if ($this->logoLight) {
            if ($branding->logo_light_path) {
                Storage::disk('public')->delete($branding->logo_light_path);
            }
            $branding->logo_light_path = $this->logoLight->store('branding', 'public');
            $this->existingLogoLight = $branding->logo_light_path;
        }

        if ($this->favicon) {
            if ($branding->favicon_path) {
                Storage::disk('public')->delete($branding->favicon_path);
            }
            $branding->favicon_path = $this->favicon->store('branding', 'public');
            $this->existingFavicon = $branding->favicon_path;
        }

        if ($this->logoSquare) {
            if ($branding->logo_square_path) {
                Storage::disk('public')->delete($branding->logo_square_path);
            }
            $branding->logo_square_path = $this->logoSquare->store('branding', 'public');
            $this->existingLogoSquare = $branding->logo_square_path;
        }

        if ($this->logoLandscape) {
            if ($branding->logo_landscape_path) {
                Storage::disk('public')->delete($branding->logo_landscape_path);
            }
            $branding->logo_landscape_path = $this->logoLandscape->store('branding', 'public');
            $this->existingLogoLandscape = $branding->logo_landscape_path;
        }

        // Update branding data
        $branding->workspace_id = $workspace->id;
        $branding->display_name = $this->displayName;
        $branding->company_name = $this->companyName;
        $branding->logo_link_url = $this->logoLinkUrl;
        $branding->default_logo_layout = $this->defaultLogoLayout;
        $branding->save();

        // Reset file upload properties
        $this->reset(['logoLight', 'favicon', 'logoSquare', 'logoLandscape']);

        session()->flash('success', 'General settings updated successfully!');
    }

    public function toggleNavigationItem($index)
    {
        $this->navigationItems[$index]['is_active'] = !$this->navigationItems[$index]['is_active'];
    }

    public function startEditingLabel($index)
    {
        $this->editingItemId = $this->navigationItems[$index]['id'];
        $this->editingLabel = $this->navigationItems[$index]['label'];
    }

    public function saveLabel($index)
    {
        if (!$this->editingItemId) {
            return;
        }

        $this->validate([
            'editingLabel' => 'required|string|min:1|max:255',
        ]);

        $this->navigationItems[$index]['label'] = $this->editingLabel;
        $this->editingItemId = null;
        $this->editingLabel = '';
    }

    public function cancelEditing()
    {
        $this->editingItemId = null;
        $this->editingLabel = '';
    }

    public function moveUp($index)
    {
        if ($index > 0) {
            $temp = $this->navigationItems[$index];
            $this->navigationItems[$index] = $this->navigationItems[$index - 1];
            $this->navigationItems[$index - 1] = $temp;
        }
    }

    public function moveDown($index)
    {
        if ($index < count($this->navigationItems) - 1) {
            $temp = $this->navigationItems[$index];
            $this->navigationItems[$index] = $this->navigationItems[$index + 1];
            $this->navigationItems[$index + 1] = $temp;
        }
    }

    public function updateNavigations()
    {
        $this->validate([
            'navigationItems.*.label' => 'required|string|min:1|max:255',
        ]);

        $workspace = Auth::user()->workspace;

        foreach ($this->navigationItems as $index => $item) {
            $navItem = WorkspaceNavigationItem::where('workspace_id', $workspace->id)
                ->where('id', $item['id'])
                ->firstOrFail();

            $navItem->label = $item['label'];
            $navItem->is_active = $item['is_active'];
            $navItem->sort_order = $index + 1;
            $navItem->save();
        }

        $this->loadNavigationItems();
        session()->flash('success', 'Site navigations updated successfully!');
    }

    public function render()
    {
        return view('livewire.settings.general')->layout('layouts.app');
    }
}
