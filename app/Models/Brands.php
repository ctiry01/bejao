<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Brands extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'key',
        'name',
        'is_active',
    ];

    public static function init(string $name): Brands
    {
        return Brands::create([
            'key' => 'b-' . Uuid::uuid4(),
            'name' => $name,
        ]);
    }

    public function scopeByKey($query, string $key){
        return $query->where('key', $key);
    }
}
