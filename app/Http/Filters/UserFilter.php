<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends QueryFilter
{
    /**
     * @param string $email
     */
    public function email(string $email)
    {
        $this->builder->where('email', strtolower($email));
    }

    /**
     * @param string $firstname
     */
    public function firstname(string $firstname)
    {
        $words = array_filter(explode(' ', $firstname));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('first_name', 'like', "%$word%");
            }
        });
    }

    /**
     * @param string $lastname
     */
    public function lastname(string $lastname)
    {
        $words = array_filter(explode(' ', $lastname));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('last_name', 'like', "%$word%");
            }
        });
    }
}
