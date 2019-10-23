<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AccountUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'   => 'required|string|max:15|regex:/^[a-zA-Z0-9_]+$/',
            'user_name' => 'required|string|max:15',
            'email'     => 'required|string|email|max:255|' . Rule::unique('users')->ignore(Auth::id())
        ];
    }
}
