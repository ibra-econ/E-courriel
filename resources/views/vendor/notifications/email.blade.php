@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Oups!')
@else
# @lang('Bonjour!')
@endif
@endif

<p>Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte</p>

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'success',
    };
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

<p>Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.</p>
<p>Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.</p>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Salutations'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(

    "Si vous rencontrez des difficultés pour cliquer sur \":actionText\" button, copiez et collez l'URL ci-dessous\n".
    'dans votre navigateur Web:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
