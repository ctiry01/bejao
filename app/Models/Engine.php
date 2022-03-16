<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Engine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'key',
        'name',
        'is_active',
    ];

    const ENGINE_DIESEL = 'diesel';
    const ENGINE_GASOLINE = 'gasoline';
    const ENGINE_ELECTRIC = 'electric';
    const ENGINE_HYBRID = 'hybrid';

    public static function init(string $name): Engine
    {
        return Engine::create([
            'key' => 'e-' . Uuid::uuid4(),
            'name' => $name,
        ]);
    }

    public function scopeByKey($query, string $key){
        return $query->where('key', $key);
    }
}
