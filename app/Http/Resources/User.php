<?php

namespace App\Http\Resources;

use App\Traits\FiltratableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatar' => $this->avatar,
            'birthday' => $this->birthday,
            'created_at' => $this->created_at,
            'posts' => UserPosts::collection($this->posts),
            'comments' => UserComments::collection( $this->comments),
        ]);
    }
}
