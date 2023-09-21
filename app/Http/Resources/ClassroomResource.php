<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassroomResource extends JsonResource
{
    public function __construct(...$args){
        parent::__construct(...$args);
        ResourceCollection::withoutWrapping();
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'title' => $this->name,
            'meta' => [
                'section' => $this->section,
                'subject' => $this->subject,
                'room' => $this->room,
            ],
            'user' => [
                'name' => $this->user->name,
                'student' => $this->studends_count,
            ]
        ];
    }
}
