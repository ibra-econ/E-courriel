@component('mail::message')
<p>Vous avez été imputer d'un nouveau courrier</p>
<h5>Reference: {{ $courrier["reference"] }}</h5>
<h5>Numero: {{ $courrier["numero"] }}</h5>
<h5>Priorité: {{ $courrier["priorite"] }}</h5>
<h5>Objet: {{ $courrier["objet"] }}</h5>
<h5>Date arrivée: {{ $courrier["date_arriver"] }}</h5>
Merci,<br>
{{ config('app.name') }}
@endcomponent

