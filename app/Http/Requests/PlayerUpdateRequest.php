<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerUpdateRequest extends FormRequest
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
            'name' => 'string',
            'age' => 'integer',
            'jersey_num' => 'integer',
            'team_id' => 'integer|exists:teams,id',
            'position_id' => 'integer|exists:positions,id',
        ];
    }
}
