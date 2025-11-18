<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Modules\Settings\Models\WorkspaceInvitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\WorkspaceInvitationMail;

class Invite extends Component
{
    public $email;
    public $role = 'viewer';

    // Edit member properties
    public $editingMemberId = null;
    public $editMemberName = '';
    public $editMemberEmail = '';
    public $editMemberRole = '';
    public $editMemberIsActive = true;
    public $editMemberCanLogin = true;

    public $roles = [
        'owner' => 'Owner',
        'admin' => 'Admin',
        'viewer' => 'Viewer',
        'read_only' => 'Read Only',
    ];

    protected $rules = [
        'email' => 'required|email|max:255',
        'role' => 'required|in:owner,admin,viewer,read_only',
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

        // Send invitation email
        Mail::to($this->email)->send(new WorkspaceInvitationMail($invitation));

        session()->flash('success', 'Invitation sent successfully!');

        // Reset form
        $this->reset(['email', 'role']);
        $this->role = 'viewer';
    }

    public function deleteInvitation($invitationId)
    {
        $workspace = Auth::user()->workspace;

        $invitation = $workspace->invitations()->findOrFail($invitationId);
        $invitation->delete();

        session()->flash('success', 'Invitation deleted successfully!');
    }

    public function editMember($memberId)
    {
        $workspace = Auth::user()->workspace;
        $member = $workspace->users()->findOrFail($memberId);

        $this->editingMemberId = $member->id;
        $this->editMemberName = $member->name;
        $this->editMemberEmail = $member->email;
        $this->editMemberRole = $member->role ?? 'viewer';
        $this->editMemberIsActive = $member->is_active;
        $this->editMemberCanLogin = $member->can_login;
    }

    public function updateMember()
    {
        $this->validate([
            'editMemberName' => 'required|string|max:255',
            'editMemberRole' => 'required|in:owner,admin,viewer,read_only',
        ]);

        $workspace = Auth::user()->workspace;
        $member = $workspace->users()->findOrFail($this->editingMemberId);

        $member->update([
            'name' => $this->editMemberName,
            'role' => $this->editMemberRole,
            'is_active' => $this->editMemberIsActive,
            'can_login' => $this->editMemberCanLogin,
        ]);

        $this->cancelEdit();
        session()->flash('success', 'Member updated successfully!');
    }

    public function cancelEdit()
    {
        $this->editingMemberId = null;
        $this->editMemberName = '';
        $this->editMemberEmail = '';
        $this->editMemberRole = '';
        $this->editMemberIsActive = true;
        $this->editMemberCanLogin = true;
    }

    public function render()
    {
        $workspace = Auth::user()->workspace;

        return view('livewire.settings.invite', [
            'pendingInvitations' => $workspace->invitations()->where('status', 'pending')->get(),
            'members' => $workspace->users()->get(),
        ])->layout('layouts.app');
    }
}
