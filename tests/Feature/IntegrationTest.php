<?php

namespace Tests\Feature;

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
            'password' => 'password',
            'origin' => 'barcelona',
            'origin_address' => 'sevilla',
            'destination_address' => 'asdfasdf'
        ]);

        //then
        $response->assertStatus(201);
        self::removeRecords();
    }

    public function test_register_with_vehicle()
    {
        //given

        //when
        $response = $this->post('/api/register', [
            'name' => 'example',
            'email' => 'example@mail.com',
            'password' => 'password',
            'origin' => 'barcelona',
            'origin_address' => 'sevilla',
            'destination_address' => 'asdfasdf',
            'brand' => 'brand',
            'model' => 'model',
            'seats' => 4,
            'fuel_consumption' => 6,
        ]);

        //then
        $response->assertStatus(201);
        self::removeRecords();
    }


    public function test_vehicle_create()
    {
        //given
        self::createExampleUser();

        //when
        $response = $this->post('/api/vehicle', [
            'brand' => 'brand',
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
        $user = self::createExampleUser();
        self::createExampleVehicle($user);

        //when
        $response = $this->post('/api/vehicle/enable', [
            'key' => $user->vehicle->key,
        ], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    public function test_vehicle_disable()
    {
        //given
        $user = self::createExampleUser();
        self::createExampleVehicle($user);

        //when
        $response = $this->post('/api/vehicle/disable', [
            'key' => $user->vehicle->key,
        ], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    public function test_require_search_vehicle()
    {
        //given
        self::createExampleUser();

        //when
        $response = $this->post('/api/request-vehicle', [], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    public function test_require_search_vehicle_custom_address()
    {
        //given
        self::createExampleUser();

        //when
        $response = $this->post('/api/request-vehicle', [
            'origin_address' => 'origin',
            'destination_address' => 'destination',

        ], ['Authorization' => self::getToken()]);

        //then
        $response->assertStatus(200);
        self::removeRecords();
    }

    //private methods
    private function createExampleUser(): User
    {
        return User::init(
            'name',
            'example@mail.com',
            'asdfasdf',
            'origin',
            'destination',
        );
    }

    private function createExampleVehicle(User $user): Vehicle
    {
        return Vehicle::init(
            'any brand',
            'any model',
            5,
            6.4,
            $user
        );
    }

    private function removeRecords()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();
        DB::table('vehicles')->truncate();
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
