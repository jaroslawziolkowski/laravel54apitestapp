<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserCreate extends FormRequest
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
            'first_name'=> 'required|string|max:255',
            'last_name'=> 'required:max:255|string',
            'gender'=> 'required:size:1|string',
            'email'=> 'required|unique:users|max:150|email',
            'country' => 'required|size:2|string'
        ];
    }
}
