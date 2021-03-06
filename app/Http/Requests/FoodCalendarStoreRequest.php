<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodCalendarStoreRequest extends FormRequest
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
            'users_menus_id' => ['required', 'integer', 'exists:user_menus,id'],
            'day' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
