<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends QueryFilter
{
    /**
     * @param string $status
     */
    public function status(string $status)
    {
        $this->builder->where('status', strtolower($status));
    }

    /**
     * @param string $title
     */
    public function title(string $title)
    {
        $words = array_filter(explode(' ', $title));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('title', 'like', "%$word%");
            }
        });
    }

    public function content(string $content)
    {
        $words = array_filter(explode(' ', $content));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('content', 'like', "%$word%");
            }
        });
    }
}
