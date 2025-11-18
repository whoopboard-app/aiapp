<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Modules\Workspace\Models\Workspace;

class OnboardingWorkspaceInfo extends Component
{
    public $workspaceName = '';
    public $websiteUrl = '';

    protected $rules = [
        'workspaceName' => 'required|string|max:100',
        'websiteUrl' => 'nullable|url|starts_with:http://,https://',
    ];

    protected $messages = [
        'workspaceName.required' => 'Please enter your workspace name.',
        'workspaceName.max' => 'Workspace name must not exceed 100 characters.',
        'websiteUrl.url' => 'Please enter a valid URL.',
        'websiteUrl.starts_with' => 'URL must start with http:// or https://',
    ];

    public function mount()
    {
        // Pre-fill with existing workspace data
        $workspace = Auth::user()->workspace;
        
        $this->workspaceName = $workspace->name;
        $this->websiteUrl = $workspace->website_url ?? '';
    }

    /**
     * Save workspace info and complete onboarding
     */
    public function save()
    {
        $this->validate();

        $workspace = Auth::user()->workspace;

        // Update workspace
        $workspace->update([
            'name' => $this->workspaceName,
            'slug' => Workspace::generateSlug($this->workspaceName),
            'website_url' => $this->websiteUrl ?: null,
        ]);

        // Mark onboarding as complete
        Auth::user()->update(['onboarded_at' => now()]);

        // Redirect to dashboard with success message
        session()->flash('success', 'Welcome to InsightHQ! Your workspace is ready.');
        return redirect()->route('workspace.dashboard');
    }

    /**
     * Go back to previous step
     */
    public function back()
    {
        return redirect()->route('onboarding.start');
    }

    /**
     * Skip this step
     */
    public function skip()
    {
        Auth::user()->update(['onboarded_at' => now()]);
        return redirect()->route('workspace.dashboard');
    }

    public function render()
    {
        return view('livewire.onboarding.onboarding-workspace-info')
            ->layout('layouts.guest');
    }
}
