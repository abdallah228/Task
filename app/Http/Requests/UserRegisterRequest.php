<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            //
            'user_name'=>'required',
            'email'=>'required|unique:users,email,'.$this->id,
            'phone_number'=>'required|unique:users,phone_number,'.$this->id,
            'date_of_birth'=>'required',
            'password'=>'required',
        ];
    }
}
