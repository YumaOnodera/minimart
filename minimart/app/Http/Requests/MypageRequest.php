<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MypageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'goods_name'        => 'required|string|max:50',
            'goods_description' => 'required|string|max:500',
            'category'          => 'required|integer|max:3',
            'goods_url'         => 'required|string|max:1000',
            'goods_img_src'     => 'required|string|max:1000',
        ];
    }
}
