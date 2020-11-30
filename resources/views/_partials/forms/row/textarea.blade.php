<label for="{{ $name }}" class="block pb-1 text-brand-blue font-bold">{{ $label }}{{ isset($required) ? ' *' : '' }}</label>
<textarea
    name="{{ $name }}"
    id="{{ $name }}"
    {{ isset($readonly) ? 'readonly': '' }}
    {{ isset($required) ? 'required' : '' }}
    @isset ($placeholder) placeholder="{{ $placeholder }}" @endisset
    class="pw-input {{ isset($readonly) ? 'bg-white' : '' }} {{ $errors->has($name) ? 'border-brand-blue mb-1' : '' }} {{ isset($classes) ? $classes : '' }}"
>{{ old($name) ?? $value ?? ''}}</textarea>
@error($name)
<div class="mb-3 p-1 text-sm leading-none text-brand-blue" role="alert">{{ $message }}</div>
@enderror