<?php

namespace App\Models;

use App\Traits\FilterableQueryTrait;
use App\Traits\ValidateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory, ValidateTrait, FilterableQueryTrait;

    const IS_DISALLOW = 'draft';
    const IS_ALLOW = 'publish';

    protected $fillable = [
        'text',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $rules = array(
        'text' => ['required', 'string'],
    );

    protected static function booted()
    {
        static::saving(function (Comment $comment) {
            $comment->user_id = $comment->user_id ? : auth()->id();
        });
    }

    public function author(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post(): belongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function allow()
    {
        $this->status = self::IS_ALLOW;
        $this->save();
    }

    public function disAllow()
    {
        $this->status = self::IS_DISALLOW;
        $this->save();
    }

    public function toggleStatus()
    {
        if($this->status === 'draft') {
            return $this->allow();
        }

        return $this->disAllow();
    }

    public function remove()
    {
        $this->delete();
    }
}
