<x-mail::message>
# You've been invited!

Hello,

{{ $invitation->inviter->name }} has invited you to join **{{ $invitation->workspace->name }}** on InsightHQ as a **{{ ucfirst(str_replace('_', ' ', $invitation->role)) }}**.

InsightHQ helps teams manage ideas, feedback, and product development in one place.

<x-mail::button :url="$invitationUrl">
Accept Invitation
</x-mail::button>

This invitation will expire in 7 days.

If you have any questions, please contact {{ $invitation->inviter->email }}.

Thanks,<br>
The {{ $invitation->workspace->name }} Team
</x-mail::message>
