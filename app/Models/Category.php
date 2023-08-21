<?php

namespace App\Models;

use App\Traits\ValidateTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, Sluggable, ValidateTrait;

    protected $fillable = [
        'title',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $rules = array(
        'title' => ['required', 'string', 'max:255'],
    );

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
