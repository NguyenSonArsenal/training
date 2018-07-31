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
        $params = $request->all();
        $image = array_get($params, 'image', null);

        $rules = [];
        if ($image != null) {
            $rules += ['image' => 'bail|required|mimes:jpeg,png,jpg,gif,svg|max:2048'];
            doUploadToFoderTmp($image);
        }

        $rules += [
            'name' =>  'bail|required',
            'email' =>  'bail|required|email|max:128|unique:admins,email,' . $request->id,
            'password' =>  'bail|required|confirmed|max:64',
            //'image' => 'bail|required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        return $rules;
    }
}