<?php

namespace App\Models;

use App\Traits\ValidateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Thumbnail extends Model
{
    use HasFactory, ValidateTrait;

    protected $fillable = [
        'title',
        'path',
        'post_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $rules = array(
        'title' => ['required', 'string', 'max:255'],
        'path' => ['required', 'string'],
    );

    public function post(): belongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
