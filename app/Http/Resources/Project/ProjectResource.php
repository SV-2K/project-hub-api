<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            $this->id,
            $this->name,
            $this->description
        ];
    }
}
