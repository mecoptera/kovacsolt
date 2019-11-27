@component('mail::message')
# Üdv!

Kérjük, hogy a lenti gombra kattintva erősítsd meg a regisztrációd.

@component('mail::button', [ 'url' => $verificationUrl ])
Megerősítés
@endcomponent

Amennyiben nem te kezdeményezted a regisztrációt oldalunkra, úgy ezt a levelet tekintsd semmisnek.

Köszönettel,<br>
{{ config('app.name') }} csapata
@endcomponent
