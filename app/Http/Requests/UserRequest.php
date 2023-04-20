<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $uniqueEmail = 'unique:users';
        $id = session('id');
        if ($id) {
            $uniqueEmail .= ',email,' . $id;
        }
        return [
            'name' => 'required|min:5',
            'email' => 'required|email|',
            'password' => 'required',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Group is required');
                }
            }],
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'name.min' => ':attribute must be at least :min characters',
            'email.required' => ':attribute is required',
            'email.email' => ':attribute must be type email',
            'pasword.required' => ':attribute is required',
            'group_id.interger' => ':attribute is invalid',
            'status.integer' => ':attribute is invalid'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'User name',
            'email' => 'User email',
            'password' => 'User password',
        ];
    }
}
