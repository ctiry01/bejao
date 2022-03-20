<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Engine;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        User::init('Cristian', 'ctiry01@gmail.com', 'asdfasdf', 'Barcelona', 'Sevilla');
        User::factory(4)->create();

        Brands::init('Audi');
        Brands::init('Mercedes');
        Brands::init('Seat');
        Brands::init('Renault');

        Engine::init(Engine::ENGINE_DIESEL);
        Engine::init(Engine::ENGINE_GASOLINE);
        Engine::init(Engine::ENGINE_ELECTRIC);
        Engine::init(Engine::ENGINE_HYBRID);

        Vehicle::init(
            Brands::find(2),
            'CLS',
            4,
            5,
            Engine::find(2),
            User::find(1)
        );

        Vehicle::init(
            Brands::find(2),
            'CLS AMG',
            4,
            6,
            Engine::find(2),
            User::find(2)
        );

        Vehicle::init(
            Brands::find(3),
            'Arona',
            8,
            7,
            Engine::find(4),
            User::find(3)
        );

        Vehicle::init(
            Brands::find(4),
            'Twig',
            12,
            13,
            Engine::find(3),
            User::find(4)
        );
    }
}
