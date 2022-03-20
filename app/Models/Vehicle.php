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
        'id_brand',
        'model',
        'seats',
        'fuel_consumption',
        'id_engine',
        'is_active',
        'id_user',
    ];

    public function brand(): HasOne
    {
        return $this->hasOne(Brands::class, 'id', 'id_brand');
    }

    public function engine(): HasOne
    {
        return $this->hasOne(Engine::class, 'id', 'id_engine');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public static function init(Brands $brand, string $model, int $seats, float $fuel_consumtion, Engine $engine, User $user): Vehicle
    {
        return Vehicle::create([
            'key' => 'v-' . Uuid::uuid4(),
            'id_brand' => $brand->id,
            'model' => $model,
            'seats' => $seats,
            'fuel_consumption' => $fuel_consumtion,
            'id_engine' => $engine->id,
            'id_user' => $user->id
        ]);
    }

    public function serialize()
    {
        return [
            'key' => $this->key,
            'brand' => $this->brand->name,
            'model' => $this->model,
            'seats' => $this->seats,
            'fuel_consumption' => $this->fuel_consumption,
            'engine' => $this->engine->name,
            'active' => (bool)$this->is_active,
            'user' => $this->user->serialize()
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
