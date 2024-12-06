<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // dd($this->toArray($request));
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'deleted_at' => $this->deleted_at
        ];
    }
}

