<label class="block mb-1 text-sm font-bold text-brand-blue" for="{{ $name }}">{{ $label }}{{ isset($required) ? ' *' : '' }}</label>
<input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" @isset ($placeholder) placeholder="{{ $placeholder }}" @endisset value="{{ old( $name ) }}" {{ isset($required) ? 'required' : '' }} class="appearance-none border rounded w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline {{ $errors->has( $name ) ? 'border-brand-yellow mb-1' : 'border-gray-400 mb-4' }}">
@error($name)
<div class="mb-3 p-2 rounded text-sm leading-none text-brand-blue bg-brand-gray-100" role="alert">{{ $message }}</div>
@enderror