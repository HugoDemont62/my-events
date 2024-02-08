<!DOCTYPE html>
<html>
<head>
    <title>Confirmation d'inscription à l'événement</title>
</head>
<body>
    <h1>Bonjour, {{ $user->name }}</h1>
    <p>Nous sommes ravis de vous annoncer que votre inscription à l'événement {{ $event->name }} a été confirmée.</p>
    <p>L'événement aura lieu le {{ $event->date }} à {{ $event->location }}.</p>
    <p>Nous avons hâte de vous y voir !</p>
    <br>
    <br>
    <a href="/events/{{ $event->id }}">Voir les événements</a>
</body>
</html>
