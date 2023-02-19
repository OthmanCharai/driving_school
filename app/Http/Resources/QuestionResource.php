<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'voice' => $this->voice,
            'sub_exam_id' => $this->sub_exam_id,
            'options' =>$this->options,
            'image'=>$this->image
        ];
    }
}