<div class="{{ $errors->has( $name ) ? 'py-0' : 'py-3 mb-3' }}">
    <div class="inline-block align-middle">
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" />
        <label for="{{ $name }}"></label>
    </div>
    <label class="text-sm font-bold text-brand-blue" for="{{ $name }}">{{ $label }}</label>
</div>
@error($name)
<div class="mb-3 p-2 rounded text-sm leading-none text-brand-blue bg-brand-gray-100" role="alert">{{ $message }}</div>
@enderror