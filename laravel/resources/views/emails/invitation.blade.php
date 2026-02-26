<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; padding: 2rem; color: #0f172a;">

    <h2>EasyColoc</h2>

    <p>Vous avez été invité à rejoindre la colocation <strong>{{ $invitation->colocation->name }}</strong>.</p>

    <p>Cliquez sur le lien ci-dessous pour accepter l'invitation :</p>

    <a href="{{ route('accept_invitation', $invitation->token) }}"
       style="display:inline-block; padding: .75rem 1.5rem; background:#2563EB; color:white; border-radius:6px; text-decoration:none;">
        Accepter l'invitation
    </a>



</body>
</html>