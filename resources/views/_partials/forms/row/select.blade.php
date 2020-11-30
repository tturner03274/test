
<label for="{{ $name }}" class="block text-brand-blue font-bold pb-1">{{ $label }}{{ isset($required) ? ' *' : '' }}</label>
<select
    name="{{ $name }}"
    id="{{ $name }}"
    class="block bg-brand-gray-100 text-brand-blue border rounded p-3 leading-tight {{ $errors->has($name) ? 'border-brand-blue mb-1' : 'border-brand-gray-400 mb-6' }} {{ isset($classes) ? $classes : '' }}"
>    
    @foreach($options as $option)
    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
    @endforeach
</select>
@error($name)
<div class="mb-3 p-1 text-sm leading-none text-brand-blue" role="alert">{{ $message }}</div>
@enderror
