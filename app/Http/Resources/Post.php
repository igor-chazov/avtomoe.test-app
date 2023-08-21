<?php

namespace App\Http\Resources;

use App\Traits\FiltratableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    use FiltratableTrait;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->filtrateFields([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'author' => (new User($this->author))->only('id', 'first_name', 'last_name', 'birthday'),
            'category' => (new Category($this->category))->except('created_at'),
            'image' => (new Thumbnail($this->thumbnail))->except('post_id', 'created_at', 'updated_at'),
        ]);
    }
}
