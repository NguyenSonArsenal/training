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
        $image = array_get($request->all(), 'image', null);
        $rules = ['image' => 'bail|mimes:jpeg,png,jpg,gif|max:' . getConstant('MAX_IMAGE_UPLOAD')]; // max:10240 = max 10 MB

        if ($image && validateImage('image')) {
            if (session()->has('image.pathImgTmp')) {
                $fileTmp = public_path(session()->get('image.pathImgTmp'));
                deleteFileTmp($fileTmp);
            }
            doUploadToFoderTmp($image);
        }

        $rules += [
            'name' => 'bail|required',
            'email' => 'bail|required|email|max:128|unique:admins,email,' . $request->id,
            'password' => 'bail|required|confirmed|max:64',
        ];
        return $rules;
    }
}