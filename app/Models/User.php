<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\FilterableQueryTrait;
use App\Traits\HasRolesAndPermissionsTrait;
use App\Traits\ValidateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, ValidateTrait, HasRolesAndPermissionsTrait, FilterableQueryTrait;

    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $rules = array(
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
        'confirm_password' => ['required', 'same:password'],
    );

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function setRules($rules)
    {
        $this->rules = $rules;
    }
}
