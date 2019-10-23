<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'    => 'required|string|max:15',
            'introduction' => 'required|string|max:140|',
            'avatar_img'   => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'header_img'   => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_url'     => 'nullable|string|max:1000'
        ];
    }
}
