<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_responsel() {
        //todo add factories to all models
        $email = uniqid() . '@domain.com';

        $admin_user = User::create(array(
            'name' => 'thomas',
            'surname' => 'frey',
            'email' => $email,
            'password' => Hash::make('password')
        ));

        $response = $this->post('/login', [
            'email' => $email,
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($admin_user);

        $response = $this->get('/logout');

        $response->assertStatus(302);
        $this->assertGuest();
    }
}
