<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'firstname'  => 'required'   ,
            'lastname'   => 'required'   ,
            'phone'      => 'required'   ,
            'name'       => 'required'   ,
            'email'      => 'required'   ,
            'password'   => 'required'   ,
            'status'     => 'required'   ,
        ];
    }

    public function messages()
    {
        return [
            'firstname.required'  =>  'First Name is Required' ,
            'lastname.required'   =>  'Last Name is Required'  ,
            'phone.required'      =>  'Phone is Required'      ,
            'name.required'       =>  'name is Required'       ,
            'email.required'      =>  'Email is Required'      ,
            'password.required'   =>  'Password is Required'   ,
            'status.required'     =>  'Status is Required'     ,
        ];
    }
}
