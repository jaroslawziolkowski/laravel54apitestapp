<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostReport extends FormRequest
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
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d',
            'user_id' => 'numeric|min:1',
            'type' => 'in:withdraw,deposit',
            'country' => 'string|size:2'
        ];
    }
}
