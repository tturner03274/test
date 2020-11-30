<div class="{{ $errors->has( $name ) ? 'py-0' : 'py-3 mb-3' }} {{ isset($classes) ? $classes : '' }}">
    <div class="inline-block align-middle">
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" {{ ( old($name ) == 'on' ) ? 'checked' : '' }} />
        <label for="{{ $name }}"></label>
    </div>
    <label class="font-bold text-brand-blue" for="{{ $name }}">{{ $label }}</label>
</div>



@error($name)
<div class="mb-3 p-2 rounded text-base leading-none text-brand-blue bg-brand-yellow" role="alert">{{ $message }}</div>
@enderror