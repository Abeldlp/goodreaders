<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBookRequest extends FormRequest
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
            'title' => 'string|required',
            'description' => 'string',
            'image' => 'image|required',
            'genre' => 'required',
            'buy_link' => '',
            'user_id' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please input the title',
            'description.string' => 'Please input a valid text',
            'image.image' => 'Please select a valid format',
            'image.required' => 'Please select an image',
        ];
    }
}


