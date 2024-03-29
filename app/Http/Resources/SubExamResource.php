<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'note' => $this->note,
            'exam_id' => $this->exam_id,
            'questions' =>QuestionCollection::make($this->whenLoaded('questions')),
        ];
    }
}
