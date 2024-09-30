<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "name" => $this->name,
            "title" => $this->title,
            "created_at" => (string)$this->created_at,
            "updated_at" => (string)$this->updated_at,
            "permissions" => $this->whenLoaded('permissions', function () {
                return $this->permissions->pluck('id');
            })
        ];
    }
}
