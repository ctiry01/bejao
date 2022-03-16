<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'name',
        'email',
        'password',
        'is_active'
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


    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'id_user', 'id');
    }

    public function journeys(): HasMany
    {
        return $this->hasMany(Journey::class, 'id_user', 'id');
    }

    public static function init(string $name, string $email, string $password): User
    {
        return User::create([
            'key' => 'u-' . Uuid::uuid4(),
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }

    public function serialize(): array
    {

        $bufferJourneys = [];

        foreach ($this->journeys as $journey) {
            $bufferJourneys [] = $journey->serialize();
        }

        return [
            'name' => $this->name,
            'email' => $this->email,
            'journeys' => $bufferJourneys
        ];
    }

    public function scopeByEmail($query, string $email)
    {
        return $query->where('email', $email);
    }
}
