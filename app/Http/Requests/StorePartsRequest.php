<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartsRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('create-parts-request');
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // strip spaces out of registration so regex can be performed
            'vehicle_registration' => str_ireplace(' ', '', ($this->vehicle_registration)),
        ]);
    }

    public function rules()
    {
        return [
            'vehicle_registration' => ['required', 'regex:/(?<Current>^[A-Z]{2}[0-9]{2}[A-Z]{3}$)|(?<Prefix>^[A-Z][0-9]{1,3}[A-Z]{3}$)|(?<Suffix>^[A-Z]{3}[0-9]{1,3}[A-Z]$)|(?<DatelessLongNumberPrefix>^[0-9]{1,4}[A-Z]{1,2}$)|(?<DatelessShortNumberPrefix>^[0-9]{1,3}[A-Z]{1,3}$)|(?<DatelessLongNumberSuffix>^[A-Z]{1,2}[0-9]{1,4}$)|(?<DatelessShortNumberSufix>^[A-Z]{1,3}[0-9]{1,3}$)|(?<DatelessNorthernIreland>^[A-Z]{1,3}[0-9]{1,4}$)|(?<DiplomaticPlate>^[0-9]{3}[DX]{1}[0-9]{3}$)/'],
            'vehicle_make' => ['required', 'string', 'min:2', 'max:20'],
            'vehicle_model' => ['required', 'string', 'min:1', 'max:20'],
            'vehicle_year' => ['required', 'string', 'min:2', 'max:20'],
            'mot_expiry' => ['required', 'string', 'min:2', 'max:20'],
            'part_types' => ['required'],
            'part_types.*' => ['required', 'max:50'],
            'parts_description' => ['nullable', 'string', 'min:3', 'max:255'],
            'deadline' => ['required', 'integer', 'min:10', 'max:12000'],
            'delivery_postcode' => ['required', 'string', 'min:4', 'regex:/([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})/'],
            'parts_images.*' => ['string', 'regex:/\S{30,50}.(jpe?g|png|gif|bmp)$/']
        ];
    }
}
