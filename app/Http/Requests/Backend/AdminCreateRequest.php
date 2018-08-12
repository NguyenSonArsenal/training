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
        $rules = ['image' => 'bail|mimes:jpeg,png,jpg,gif|max:' . getConstant('MAX_IMAGE_UPLOAD')]; // max:10240 = 10MB

        if (empty($image)) {
            if (session()->has('tmpImage')) {
                session()->flash('hasTmpImage', true);
            }
        } else {
            if (validateImage('image')) {
                if (session()->has('tmpImage.pathImgTmp')) {
                    deleteFileTmp(public_path(session()->get('tmpImage.pathImgTmp')));
                }
                doUploadToFoderTmp($image);
            }
        }

        $rules += [
            'name' => 'bail|required',
            'email' => 'bail|required|email|max:128|unique:admins,email,' . $request->id,
            'password' => 'bail|required|confirmed|max:64',
        ];
        return $rules;
    }
}