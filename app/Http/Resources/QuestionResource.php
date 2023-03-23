<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'options' =>OptionCollection::make($this->whenLoaded('options')),
            'dropzones' =>DropzonCollection::make($this->whenLoaded('dropzons')),
            'image'=>($this->image!='')?Storage::cloud()->temporaryUrl($this->image,now()->addHours(23)):'',
            'images'=>ImageCollection::make($this->whenLoaded('images')),
            'type'=>$this->type
        ];
    }
}
