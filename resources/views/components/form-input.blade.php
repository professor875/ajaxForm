@props(['label', 'type' => 'text'])

<div class="mb-6">
    <label for="{{ $label }}"
           class="block mb-2 uppercase font-bold text-sm text-white">
        {{ $label }}
    </label>

    <input type="{{ $type }}"
           name="{{ $label }}"
           id="{{ $label }}"
           value="{{ old($label) }}"
           placeholder="Write your {{ $label }}.."
           class="border border-gray-400 p-2 w-full text-black rounded-xl">

</div>
