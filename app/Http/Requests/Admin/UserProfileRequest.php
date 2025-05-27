<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $name_rules = ["required"];

        switch($this->method())
        {
            case 'POST':
            {
                $name_rules = array_merge($name_rules, ['unique:users']);
            }
            case 'PUT':
            case 'PATCH':
            {
                $name_rules= array_merge($name_rules, ['unique:users,email,'. $this->segment(3).',user_id']);
            }
            default:
                break;
        }
        return ["email"=>implode('|', $name_rules),'firstname'=>'required'];
    }
    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken. Enter different email.'
        ];
    }
}
