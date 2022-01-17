<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class TeamStoreRequest extends FormRequest
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
        //TODO validar que se pueda agregar el mismo nombre solo si no esta en la misca cagegoria
        return [
            'name' => [
                'required',
                Rule::unique('teams')->where(function($q) {
                    return $q->where('category_id', $this->category_id);
//                    return $q->where('deleted_at', null)
//                        ->where('category_id', !$this->category_id);
                }),
            ],
            'group' => 'string|max:1',
            'category_id' => 'required|exists:categories,id',
            'won' => 'integer',
            'draw' => 'integer',
            'lost' => 'integer',
            'goals_against' => 'integer',
            'goals_for' => 'integer',
            'goals_difference' => 'integer',
            'points' => 'integer',
        ];
    }
}
