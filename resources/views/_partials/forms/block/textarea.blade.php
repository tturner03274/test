<label class="block mb-1 text-sm font-bold text-brand-blue" for="{{ $name }}">{{ $label }}{{ isset($required) ? ' *' : '' }}</label>
<textarea
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    @isset ($placeholder) placeholder="{{ $placeholder }}" @endisset
    {{ isset($required) ? 'required' : '' }}
    class="appearance-none border rounded w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline {{ $errors->has( $name ) ? 'border-brand-yellow mb-1' : 'border-gray-400 mb-4' }}"
>CB1,CM17,IP26,SG8,PE27,EN11,CB10,CM18,IP27,SG9,PE28,CB11,CM19,IP28,SG10,CB21,CM20,IP29,SG11,CB22,CM21,SG12,CB23,CM22,SG13,CB24,CM23,SG14,CB25,CM24,SG19,CB3,CM6,CB4,CM7,CB5,CB6,CB7,CB8,CB9
{{ old( $name ) }}
</textarea>
@error($name)
<div class="mb-3 p-2 rounded text-sm leading-none text-brand-blue bg-brand-gray-100" role="alert">{{ $message }}</div>
@enderror