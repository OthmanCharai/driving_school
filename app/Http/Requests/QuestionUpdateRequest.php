<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string'],
            'image'=>['mimes:png,jpeg,jpg'],
            "type"=>['required'],
            'sub_exam_id' => ['required', 'exists:sub_exams,id'],
        ];
    }
}
