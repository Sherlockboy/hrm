<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'position' => $this->position,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'linkedin_url' => $this->linkedin_url,
            'status' => $this->status,
            'skills' => SkillResource::collection($this->whenLoaded('skills')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'comments' => CommentResource::collection($this->whenLoaded('comments'))
        ];
    }
}
