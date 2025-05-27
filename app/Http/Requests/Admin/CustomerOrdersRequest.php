<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerOrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sr_no' => 'required',
            'customer_id' => 'required',
            'date' => 'required'     
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sr_no.required' => 'The Serial No. field is required',
            'customer_id.required' => 'The Customer field is required',
            'date.required' => 'The Date field is required'
        ];
    }
}
