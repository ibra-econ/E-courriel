@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-danger">
            {{ __("Oups ! Quelque chose s'est mal passé") }}
        </div>

        <ul class="mt-3 text-sm text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
