<?php

namespace Tests\Feature;

use App\Models\Brands;
use App\Models\Engine;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login()
    {
        //given
        self::createExampleUser();

        //when
        $response = $this->post('/api/login', [
            'email' => 'example@mail.com',
            'password' => 'asdfasdf'
        ]);

        //then
        $response->assertStatus(201);
        self::removeRecords();
    }

    public function test_register()
    {
        //given

        //when
        $response = $this->post('/api/register', [
            'name' => 'example',
            'email' => 'example@mail.com',
            'password' => 'asdfasdf'
        ]);

        //then
        $response->assertStatus(201);
        self::removeRecords();
    }

    public function test_vehicles()
    {
        //given
        self::createExampleUser();

        //when
        $response = $this->get('/api/vehicles', ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    public function test_vehicle_create()
    {
        //given
        self::createExampleUser();
        $brand = self::createExampleBrand();
        $engine = self::createExampleEngine();

        //when
        $response = $this->post('/api/vehicle', [
            'brandKey' => $brand->key,
            'engineKey' => $engine->key,
            'model' => 'A5',
            'seats' => 5,
            'fuel_consumption' => 6
        ], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(201);
        self::removeRecords();
    }

    public function test_vehicle_enable()
    {
        //given
        $vehicle = self::createExampleVehicle();

        //when
        $response = $this->post('/api/vehicle/enable', [
            'key' => $vehicle->key,
        ], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    public function test_vehicle_disable()
    {
        //given
        $vehicle = self::createExampleVehicle();

        //when
        $response = $this->post('/api/vehicle/enable', [
            'key' => $vehicle->key,
        ], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    //private methods
    private function createExampleUser(): User
    {
        return User::init(
            'test',
            'example@mail.com',
            'asdfasdf'
        );
    }

    private function createExampleVehicle(): Vehicle
    {
        return Vehicle::init(
            self::createExampleBrand(),
            'any model',
            5,
            6.4,
            self::createExampleEngine(),
            self::createExampleUser()
        );
    }

    private function createExampleBrand(): Brands
    {
        return Brands::init(
            'any brand'
        );
    }

    private function createExampleEngine(): Engine
    {
        return Engine::init(
            'any engine'
        );
    }

    private function removeRecords()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('brands')->truncate();
        DB::table('engines')->truncate();
        DB::table('users')->truncate();
        DB::table('vehicles')->truncate();
        DB::table('journeys')->truncate();
    }

    private function getToken()
    {
        $response = $this->post('/api/login', [
            'email' => 'example@mail.com',
            'password' => 'asdfasdf'
        ]);

        return 'Bearer ' . $response['token'];
    }
}
