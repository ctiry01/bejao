<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Engine;
use App\Models\Journey;
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
        User::init('Cristian', 'ctiry01@gmail.com', 'asdfasdf');
        User::factory(5)->create();

        Brands::init('Audi');
        Brands::init('Mercedes');
        Brands::init('Seat');
        Brands::init('Renault');

        Engine::init(Engine::ENGINE_DIESEL);
        Engine::init(Engine::ENGINE_GASOLINE);
        Engine::init(Engine::ENGINE_ELECTRIC);
        Engine::init(Engine::ENGINE_HYBRID);

        Vehicle::init(
            Brands::find(1),
            'A4',
            5,
            6.0,
            Engine::find(1),
            User::find(1)
        );

        Vehicle::init(
            Brands::find(2),
            'CLS AMG',
            5,
            8.0,
            Engine::find(2),
            User::find(2)
        );

        Vehicle::init(
            Brands::find(3),
            'Arona',
            7,
            5.0,
            Engine::find(4),
            User::find(3)
        );

        Vehicle::init(
            Brands::find(4),
            'Twig',
            2,
            0.0,
            Engine::find(3),
            User::find(4)
        );

        Journey::init(
            'Ir al trabajo',
            'Castelldefels',
            'Barcelona',
            User::find(1),
            '08:00'
        );

        Journey::init(
            'Vuelta del trabajo',
            'Barcelona',
            'Castelldefels',
            User::find(1),
            '17:00'
        );

        Journey::init(
            'Ir al trabajo',
            'Sabadell',
            'Barcelona',
            User::find(2),
            '08:00'
        );

        Journey::init(
            'Vuelta del trabajo',
            'Barcelona',
            'Sabadell',
            User::find(2),
            '17:00'
        );
    }
}
