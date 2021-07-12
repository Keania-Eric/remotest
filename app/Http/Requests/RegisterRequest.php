<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=> ['required', 'string'],
            'email'=> ['required', 'string', 'unique:users'],
            'phone'=> ['required', 'string', 'unique:users'],
            'password'=> ['required', 'string', 'min:6', 'confirmed']
        ];
    }

    
    /**
     * Retrieve only needed data for use
     *
     * @return array
     */
    public function getSanitized()
    {
        $data = $this->validated();

        return $data;
    }
}
