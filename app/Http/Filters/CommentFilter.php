<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CommentFilter extends QueryFilter
{
    /**
     * @param string $status
     */
    public function status(string $status)
    {
        $this->builder->where('status', strtolower($status));
    }

    /**
     * @param string $text
     */
    public function text(string $text)
    {
        $words = array_filter(explode(' ', $text));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('text', 'like', "%$word%");
            }
        });
    }
}
