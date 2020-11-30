<?php

namespace App\Http\Requests;

use App\PartsRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreBid extends FormRequest
{
    public function authorize()
    {
        // Check signed URL from ajax POST
        abort_if(!request()->hasValidSignature(), 401);

        // Check if user can bid
        return auth()->user()->can('bid', $this->partsRequest);
    }

    public function rules()
    {
        return [
            'bid_lines.*.image' => ['image', 'max:5000'],
            'bid_lines.*.description' => ['required', 'max:100', 'string'],
            'bid_lines.*.brand' => ['required', 'string'],
            'bid_lines.*.retail_price' => ['required', 'min:0', 'numeric'],
            'bid_lines.*.trade_price' => ['min:0', 'required', 'numeric'],
            'bid_lines.*.quantity' => ['min:1', 'required', 'integer'],
            'bid_lines.*.availability' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        $messages = [];
        // Loop any bid_line inputs line by line
        foreach ($this->request->get('bid_lines') as $line => $requestData) {
            // Loop the data in the bid_line and add messages
            foreach ($requestData as $input => $value) {
                $messages['bid_lines.' . $line . '.' . $input . '.required'] = 'The ' . str_ireplace('_', ' ', $input) . ' on line ' . ($line + 1)  . '  is required';
                $messages['bid_lines.' . $line . '.' . $input . '.min'] = 'The ' . str_ireplace('_', ' ', $input) . ' on line ' . ($line + 1)  . '  is must be a minimum of :min.';
                $messages['bid_lines.' . $line . '.' . $input . '.max'] = 'The ' . str_ireplace('_', ' ', $input) . ' on line ' . ($line + 1)  . '  is must be a :max maximum.';
            }
        }

        return $messages;
    }
}
