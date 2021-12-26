<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodCalendarUpdateRequest extends FormRequest
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
            'users_menus_id' => ['required', 'integer', 'exists:users_menuses,id'],
            'menu_number' => ['required', 'integer'],
            'day' => ['required', 'integer'],
        ];
    }
}