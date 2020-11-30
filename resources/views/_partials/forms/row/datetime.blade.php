<label for="{{ $name }}" class="block pb-1 text-brand-blue font-bold">{{ $label }}{{ isset($required) ? ' *' : '' }}</label>

<input
    type="datetime-local"
    name="{{ $name }}"
    id="{{ $name }}"
    {{ isset($required) ? 'required' : '' }}
    class="appearance-none block max-w-full bg-brand-gray-100 text-brand-blue border rounded p-4 py-3 leading-tight {{ $errors->has($name) ? 'border-brand-blue mb-1' : 'border-brand-gray-400 mb-6' }} {{ isset($classes) ? $classes : '' }}"
>
@error($name)
<div class="mb-3 p-1 text-sm leading-none text-brand-blue" role="alert">{{ $message }}</div>
@enderror