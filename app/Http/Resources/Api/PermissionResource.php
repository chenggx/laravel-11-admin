<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'path' => $this->whenNotNull($this->path),
            'meta' => [
                'title' => $this->title,
                'icon' => $this->whenNotNull($this->icon),
                'roles' => [],
                'rank' => $this->sort
            ],
            //递归获取子集
            "children" => $this->whenLoaded('recursiveChildren', function () {
                return PermissionResource::collection($this->recursiveChildren);
            })
        ];
    }
}
