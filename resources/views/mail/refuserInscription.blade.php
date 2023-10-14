<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Elite corner</title>

        
    </head>
    <body>
        <h1 class="text-red text-center">Cher(e) étudiant</h1>
        <div class="text-center">
            votre abonnement est refuser
        </div>
        <p>
            {{ $msg }}
        </p>
    </body>
</html>
