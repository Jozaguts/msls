<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameStoreRequest extends FormRequest
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
//        TODO  REFORMULAR TABLA GAMES
//        RESULT score
        return [
            'date' =>'required|',
            'result' =>'required|',
            'score' =>'required|',
            'mvp' =>'required|',
            'referee_id' =>'required|',
            'stop1' =>'required|',
            'stop2' => 'required|',
        ];
    }
}
