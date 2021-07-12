<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'department_id'=> ['required', 'numeric', 'exists:departments,id'],
            //'user_id'=> ['required', 'numeric', 'exists:users, id'],
            'designation_id'=> ['required', 'numeric', 'exists:designations,id'],
            'emp_date'=> ['sometimes', 'string'],
        ];
    }
    
    /**
     * Method getSanitized
     *
     * @return array
     */
    public function getSanitized()
    {
        $data = $this->validated();
        return $data;
    }
}
