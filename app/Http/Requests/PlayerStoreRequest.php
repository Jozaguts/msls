<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'paternal_name' => 'required|string',
            'maternal_name' => 'required|string',
            'birthdate' => 'date|required',
            'jersey_num' => 'required',
            'team_id' => 'required|exists:teams,id',
            'position_id' => 'required|exists:positions,id',
        ];
    }
}
