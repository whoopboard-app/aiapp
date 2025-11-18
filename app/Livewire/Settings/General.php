<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class General extends Component
{
    public $workspaceName;
    public $companyName;
    public $websiteUrl;
    public $supportEmail;
    public $timezone;
    public $dateFormat;
    public $timeFormat;

    public $timezones = [
        'UTC' => 'UTC',
        'America/New_York' => 'Eastern Time (US & Canada)',
        'America/Chicago' => 'Central Time (US & Canada)',
        'America/Denver' => 'Mountain Time (US & Canada)',
        'America/Los_Angeles' => 'Pacific Time (US & Canada)',
        'Europe/London' => 'London',
        'Europe/Paris' => 'Paris',
        'Asia/Tokyo' => 'Tokyo',
        'Asia/Shanghai' => 'Beijing',
        'Australia/Sydney' => 'Sydney',
    ];

    public $dateFormats = [
        'Y-m-d' => 'YYYY-MM-DD (2025-11-18)',
        'm/d/Y' => 'MM/DD/YYYY (11/18/2025)',
        'd/m/Y' => 'DD/MM/YYYY (18/11/2025)',
        'F j, Y' => 'Month DD, YYYY (November 18, 2025)',
    ];

    public $timeFormats = [
        'H:i' => '24-hour (14:30)',
        'h:i A' => '12-hour (02:30 PM)',
    ];

    protected $rules = [
        'workspaceName' => 'required|string|min:2|max:255',
        'companyName' => 'nullable|string|max:255',
        'websiteUrl' => 'nullable|url|max:255',
        'supportEmail' => 'nullable|email|max:255',
        'timezone' => 'required|string',
        'dateFormat' => 'required|string',
        'timeFormat' => 'required|string',
    ];

    public function mount()
    {
        $workspace = Auth::user()->workspace;

        $this->workspaceName = $workspace->name;
        $this->companyName = $workspace->company_name;
        $this->websiteUrl = $workspace->website_url;
        $this->supportEmail = $workspace->support_email;
        $this->timezone = $workspace->timezone ?? 'UTC';
        $this->dateFormat = $workspace->date_format ?? 'Y-m-d';
        $this->timeFormat = $workspace->time_format ?? 'H:i';
    }

    public function save()
    {
        $this->validate();

        $workspace = Auth::user()->workspace;

        $workspace->update([
            'name' => $this->workspaceName,
            'company_name' => $this->companyName,
            'website_url' => $this->websiteUrl,
            'support_email' => $this->supportEmail,
            'timezone' => $this->timezone,
            'date_format' => $this->dateFormat,
            'time_format' => $this->timeFormat,
        ]);

        session()->flash('success', 'Settings saved successfully!');

        $this->dispatch('settings-saved');
    }

    public function render()
    {
        return view('livewire.settings.general');
    }
}
