<?php

namespace App\Models;

use App\Helpers\DistanceHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Journey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'key',
      'name',
      'origin_address',
      'destination_address',
      'time',
      'is_active',
      'id_user',
    ];

    public static function init(string $name, string $originAddress, string $destinationAddress, User $user, string $time) : Journey {
        return Journey::create([
            'key' => 'j-' . Uuid::uuid4(),
            'name' => $name,
            'origin_address' => $originAddress,
            'destination_address' => $destinationAddress,
            'time' => $time,
            'id_user' => $user->id,
        ]);
    }

    public function serialize(): array
    {
        return [
            'key' => $this->key,
            'name' => $this->name,
            'origin_address' => $this->origin_address,
            'destination_address' => $this->destination_address,
            'time' => $this->time,
            'is_active' => (bool) $this->is_active,
            //'distance' => DistanceHelper::distanceBetweenAdress($this->origin_address, $this->destination_address)
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

    public function scopeByKey($query, string $key){
        return $query->where('key', $key);
    }
}
