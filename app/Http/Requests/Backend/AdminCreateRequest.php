<?php

namespace App\Http\Requests\Backend;

use \Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $rules = [
            'name'          =>  'bail|required',
            'email'         =>  'bail|required|email|max:128|unique:admins,email,' . $request->id,
            'password'      =>  'bail|required|max:64',
            'new_password'  =>  'bail|confirmed|max:64',
        ];

        // updating
        if ($request->id) {
            $rules['password'] = 'bail|max:64';
        }

        return $rules;
    }
}