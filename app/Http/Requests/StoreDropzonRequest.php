<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDropzonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            //
            "question_id"=>  ['required', 'exists:questions,id'],
            'x_position'=>'required',
            'y_position'=>'required',
            'option_id'=> ['required', 'exists:questions,id'],

        ];
    }
}
