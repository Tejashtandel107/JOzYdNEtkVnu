<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarkaRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $name_rules = ["required","max:191"];

        switch($this->method())
        {
            case 'POST':
            {
                $name_rules = array_merge($name_rules,[Rule::unique('marka')->where('item_id', $request->item_id)]);
            }
            case 'PUT':
            case 'PATCH':
            {
                $name_rules = array_merge($name_rules,[Rule::unique('marka')->where('item_id', $request->item_id)->ignore($this->segment(3),'marka_id')]);
            }
            default:
                break;
        }
        return ['name'=>implode("|", $name_rules),'item_id'=>'required'];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'item_id.required' => 'The item field is required'
        ];
    }
}
