<?php

namespace App\Models;

use App\Traits\FilterableQueryTrait;
use App\Traits\ValidateTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory, Sluggable, ValidateTrait, FilterableQueryTrait;

    const IS_DRAFT = 'draft';
    const IS_PUBLIC = 'publish';

    protected $fillable = [
        'title',
        'description',
        'content',
    ];

    protected $rules = array(
        'title' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'content' => ['required', 'string'],
    );

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function thumbnail(): hasOne
    {
        return $this->hasOne(Thumbnail::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    protected static function booted()
    {
        static::saving(function (Post $post) {
            $post->user_id = $post->user_id ? : auth()->id();
        });
    }

    public function setDraft()
    {
        $this->status = self::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if($value === 'publish') {
            return $this->setDraft();
        }

        return $this->setPublic();
    }
}
