<?php

namespace App\Models;

use App\Traits\ValidateTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, Sluggable, ValidateTrait;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $rules = array(
        'name' => ['required', 'string', 'max:255'],
    );

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function permissions(): belongsToMany
    {
        return $this->belongsToMany(Permission::class,'permission_role');
    }
}
