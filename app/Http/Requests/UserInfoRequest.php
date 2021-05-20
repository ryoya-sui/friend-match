<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserInfoRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'img_name' => 'file|image|mimes:jpeg,png,jpg,gif|max:2000', 
            'self_introduction' => 'string|max:255',
            'email' => [
                'required', 
                'string', 
                'email',
                'max:255', 
                Rule::unique('users')->ignore(Auth::id()),
            ],
		];
    }
}
