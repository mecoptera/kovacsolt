@component('mail::message')
# Üdv!

A lenti gomb megnyomásával új jelszót adhatsz meg magadnak.

@component('mail::button', [ 'url' => $resetUrl ])
Új jelszó megadása
@endcomponent

Amennyiben nem te kezdeményezted a visszaállítást, úgy ezt a levelet tekintsd semmisnek.

Köszönettel,<br>
{{ config('app.name') }} csapata
@endcomponent
