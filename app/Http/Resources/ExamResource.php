<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        // dd(Storage::cloud()->temporaryUrl($this->image,now()->addHours(23)));
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_free'=>$this->is_free,
            'image'=>Storage::cloud()->temporaryUrl($this->image,now()->addHours(23)),
            'users' => UserCollection::make($this->whenLoaded('users')),
            'sub_exams' => SubExamCollection::make($this->whenLoaded('subExam')),
            "users_count"=>$this->whenLoaded('users', function () {
                return $this->users_count;
            })
        ];
    }
}
