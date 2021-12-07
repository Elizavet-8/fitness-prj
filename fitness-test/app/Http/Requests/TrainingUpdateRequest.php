<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingUpdateRequest extends FormRequest
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
            'training_location_id' => ['required', 'integer', 'exists:training_locations,id'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:300'],
            'training_days' => ['required', 'json'],
            'training_price' => ['required', 'double'],
        ];
    }
}
