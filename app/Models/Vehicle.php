<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'key',
        'brand',
        'model',
        'seats',
        'fuel_consumption',
        'is_active',
        'id_user',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public static function init(string $brand, string $model, int $seats, float $fuel_consumtion, User $user): Vehicle
    {
        return Vehicle::create([
            'key' => 'v-' . Uuid::uuid4(),
            'brand' => $brand,
            'model' => $model,
            'seats' => $seats,
            'fuel_consumption' => $fuel_consumtion,
            'id_user' => $user->id
        ]);
    }

    public function serialize($user = false)
    {
        return [
            'key' => $this->key,
            'brand' => $this->brand,
            'model' => $this->model,
            'seats' => $this->seats,
            'fuel_consumption' => $this->fuel_consumption,
            'active' => (bool)$this->is_active,
            'user' => $user ? $this->user->serialize() : null
        ];
    }

    public function enable()
    {
        $this->is_active = true;
    }

    public function disable()
    {
        $this->is_active = false;
    }

    public function remove()
    {
        $this->delete();
        $this->disable();
    }

    public function checkIfIsActive()
    {
        if ($this->is_active) {
            return true;
        }

        return false;
    }

    public function scopeByKey($query, string $key)
    {
        return $query->where('key', $key);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySeats($query, int $seats)
    {
        return $query->where('seats', '>=', $seats + 1);
    }

    public function scopeOthers($query, User $user)
    {
        return $query->where('id_user', '!=', $user->id);
    }
}
