<label class="block pb-1 text-brand-blue font-bold">{{ $label }}</label>
<input
    type="text"
    name="{{ $name }}"
    readonly
    value="{{ $value ?? "" }}"
    placeholder="{{ $placeholder ?? "" }}"
    class="appearance-none block max-w-full bg-white text-brand-blue border rounded p-4 py-3 leading-tight
    {{ $errors->has($name) ? 'border-brand-blue mb-1' : 'border-brand-gray-300 mb-6' }} {{ isset($classes) ? $classes : '' }}">
    
</input>
