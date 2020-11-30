    <label for="{{ $name }}" class="block pb-1 text-brand-blue font-bold">{{ $label }}{{ isset($required) ? ' *' : '' }}</label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) ?? $value ?? ''}}"
        {{ isset($required) ? 'required' : '' }}
        {{ isset($read_only) ? 'readonly' : '' }}
        @isset ($placeholder) placeholder="{{ $placeholder }}" @endisset
        class="pw-input {{ $errors->has($name) ? 'border-brand-blue mb-1' : '' }} {{ isset($classes) ? $classes : '' }}"
    >

    @error($name)
    <div class="mb-3 p-1 text-sm leading-none text-brand-blue" role="alert">{{ $message }}</div>
    @enderror