@props(['value'])

<label {{ $attributes->merge(['class' => 'block fw-bold font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
