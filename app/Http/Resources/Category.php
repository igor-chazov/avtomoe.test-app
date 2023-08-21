<?php

namespace App\Http\Resources;

use App\Traits\FiltratableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    use FiltratableTrait;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->filtrateFields([
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
        ]);
    }
}
