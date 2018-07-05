<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email'     =>  'bail|required|email|max:128',
            'password'  =>  'bail|required|max:64'
        ];
    }
    public function messages()
    {
        return [
            'email.required'    =>  'Bạn không thể bỏ trống chỗ này',
            'email.email'       =>  'Email không đúng định dạng',
            'email.max'         =>  'Email tối đa 128 kí tự',
            'password.required' =>  'Bạn không thể bỏ trống chỗ này',
            'password.max'      =>  'Mật khẩu tối đa 64 kí tự'
        ];
    }
}