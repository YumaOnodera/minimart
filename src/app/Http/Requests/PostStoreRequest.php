<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Category;

class PostStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category_count = Category::All()->count();

        return [
            'goods_name'        => 'required|string|max:50',
            'goods_description' => 'required|string|max:500',
            'category'          => 'required|integer|max:' . $category_count,
            'goods_url'         => 'required|string|max:1000',
            'goods_img'         => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
