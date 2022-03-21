<?php

namespace Database\Seeders;

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
        User::factory(11)->create();

        Vehicle::init(
            'Mercedes',
            'CLS',
            4,
            5,
            User::find(2)
        );

        Vehicle::init(
            'Audi',
            'A4',
            4,
            6,
            User::find(1)
        );

        Vehicle::init(
            'Seat',
            'Arona',
            8,
            7,
            User::find(3)
        );

        Vehicle::init(
            'Renault',
            'Twig',
            12,
            13,
            User::find(4)
        );
    }
}
