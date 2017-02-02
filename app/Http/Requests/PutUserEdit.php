<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutUserEdit extends FormRequest
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
              'id' => 'required|integer',
              'first_name'=> 'string|max:255',
              'last_name'=> 'string|max:255',
              'gender'=> 'string|size:1',
              'email'=> 'max:150|email',
              'country' => 'string|size:2',
              'bonus' => 'integer|max:20|min:5'
        ];
    }
}
