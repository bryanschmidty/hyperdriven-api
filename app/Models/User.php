<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_PARENT = 'parent';
    const TYPE_STUDENT = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',
        'parent_id',
        'school',
        'age',
        'gender',
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
    ];

    /**
     * Get the parent of the student.
     */
    public function parent()
    {
        if ($this->isStudent()) {
            return $this->belongsTo(User::class, 'parent_id');
        }

        return $this->newQuery()->where('id', '!=', $this->id);
    }

    /**
     * Get the students of the parent.
     */
    public function students()
    {
        if ($this->isParent()) {
            return $this->hasMany(User::class, 'parent_id');
        }

        return $this->newQuery()->where('id', '!=', $this->id);
    }

    public function isParent(): bool
    {
        return $this->type == self::TYPE_PARENT;
    }

    public function isStudent(): bool
    {
        return $this->type == self::TYPE_STUDENT;
    }
}
