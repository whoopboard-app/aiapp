<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;
use App\Modules\Onboarding\Models\Goal;
use App\Modules\Workspace\Models\WorkspacePreference;
use Illuminate\Support\Facades\Auth;

class OnboardingGoals extends Component
{
    public $goals = [];
    public $selectedGoals = [];

    protected $rules = [
        'selectedGoals' => 'required|array|min:1',
        'selectedGoals.*' => 'string|exists:goals,key',
    ];

    protected $messages = [
        'selectedGoals.required' => 'Please select at least one goal to continue.',
        'selectedGoals.min' => 'Please select at least one goal to continue.',
    ];

    public function mount()
    {
        // Load all active goals
        $this->goals = Goal::getActive();

        // Load previously selected goals if any
        $workspace = Auth::user()->workspace;
        $this->selectedGoals = WorkspacePreference::getGoalsForWorkspace($workspace->id);
    }

    /**
     * Toggle goal selection
     */
    public function toggleGoal($goalKey)
    {
        if (in_array($goalKey, $this->selectedGoals)) {
            // Remove if already selected
            $this->selectedGoals = array_values(
                array_filter($this->selectedGoals, fn($key) => $key !== $goalKey)
            );
        } else {
            // Add if not selected
            $this->selectedGoals[] = $goalKey;
        }
    }

    /**
     * Check if goal is selected
     */
    public function isSelected($goalKey)
    {
        return in_array($goalKey, $this->selectedGoals);
    }

    /**
     * Save and continue to next step
     */
    public function continue()
    {
        $this->validate();

        // Save selected goals to workspace preferences
        $workspace = Auth::user()->workspace;
        WorkspacePreference::saveGoalsForWorkspace($workspace->id, $this->selectedGoals);

        // Redirect to Step 2: Workspace Info
        return redirect()->route('onboarding.workspace-info');
    }

    /**
     * Skip onboarding (still saves empty preferences)
     */
    public function skip()
    {
        auth()->user()->update(['onboarded_at' => now()]);
        return redirect()->route('workspace.dashboard');
    }

    public function render()
    {
        return view('livewire.onboarding.onboarding-goals')
            ->layout('layouts.guest');
    }
}
