<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testFieldsRegistration()
    {
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "Ошибка ввода данных",
                "data" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }


    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "Баян Прохоsрович2",
            "email" => "Bayan@tesst.com",
            "password" => "1q2w3e4r5t6y"
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
            ]);
    }
}
