<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Modules\Settings\Models\WorkspaceInvitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Invite extends Component
{
    public $email;
    public $role = 'member';

    public $roles = [
        'owner' => 'Owner',
        'admin' => 'Admin',
        'member' => 'Member',
    ];

    protected $rules = [
        'email' => 'required|email|max:255',
        'role' => 'required|in:owner,admin,member',
    ];

    public function sendInvite()
    {
        $this->validate();

        $workspace = Auth::user()->workspace;

        // Check if user already exists in workspace
        $existingUser = $workspace->users()->where('email', $this->email)->first();
        if ($existingUser) {
            $this->addError('email', 'This user is already a member of your workspace.');
            return;
        }

        // Check if there's already a pending invitation
        $existingInvite = $workspace->invitations()
            ->where('email', $this->email)
            ->where('status', 'pending')
            ->first();

        if ($existingInvite) {
            $this->addError('email', 'An invitation has already been sent to this email.');
            return;
        }

        // Create invitation
        $invitation = WorkspaceInvitation::createInvitation(
            $workspace->id,
            $this->email,
            $this->role,
            Auth::id()
        );

        // TODO: Send invitation email
        // Mail::to($this->email)->send(new WorkspaceInvitationMail($invitation));

        session()->flash('success', 'Invitation sent successfully!');

        // Reset form
        $this->reset(['email', 'role']);
        $this->role = 'member';
    }

    public function deleteInvitation($invitationId)
    {
        $workspace = Auth::user()->workspace;

        $invitation = $workspace->invitations()->findOrFail($invitationId);
        $invitation->delete();

        session()->flash('success', 'Invitation deleted successfully!');
    }

    public function render()
    {
        $workspace = Auth::user()->workspace;

        return view('livewire.settings.invite', [
            'pendingInvitations' => $workspace->invitations()->where('status', 'pending')->get(),
            'members' => $workspace->users()->get(),
        ]);
    }
}
