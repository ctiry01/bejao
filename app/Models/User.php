<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'is_active',
        'origin_address',
        'destination_address',
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


    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class, 'id_user', 'id');
    }

    public static function init(string $name, string $email, string $password, string $origin, string $destination): User
    {
        return User::create([
            'key' => 'u-' . Uuid::uuid4(),
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'origin_address' => $origin,
            'destination_address' => $destination
        ]);
    }

    public function serialize(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function scopeByEmail($query, string $email)
    {
        return $query->where('email', $email);
    }

    public function scopeByOriginDestination($query, string $origin, string $destination)
    {
        return $query->where('origin_address', $origin)->where('destination_address', $destination);
    }
}
