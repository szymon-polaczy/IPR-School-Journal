<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoomTest extends TestCase
{
    public function test_creating_a_class_not_logged_in() {
        $number_of_rooms = count(Room::all());
        $name = $this->generateRandomString(10);

        $response = $this->post('/create-room', [
            'name' => $name,
        ]);

        $response->assertStatus(403);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertSame($number_of_rooms, $number_of_rooms_after_creation);
    }

    public function test_creating_a_class_logged_in() {
        $number_of_rooms = count(Room::all());
        $name = $this->generateRandomString(10);

        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $response = $this->post('/create-room', [
            'name' => $name,
        ]);

        $response->assertStatus(302);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertNotSame($number_of_rooms, $number_of_rooms_after_creation);
    }

    public function test_creating_a_class_logged_in_too_long_name() {
        $number_of_rooms = count(Room::all());
        $name = $this->generateRandomString(300);

        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $response = $this->post('/create-room', [
            'name' => $name,
        ]);

        $response->assertSessionHasErrors(['name']);

        $response->assertStatus(302);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertSame($number_of_rooms, $number_of_rooms_after_creation);
    }

    public function test_editing_a_class_not_logged_in() {
        $rooms = Room::all();
        $new_name = $this->generateRandomString(10);
        $room_id = $rooms[0]->id;

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertStatus(403);
    }

    public function test_editing_a_class_logged_in() {
        $rooms = Room::all();
        $new_name = $this->generateRandomString(10);
        $room_id = $rooms[0]->id;

        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertStatus(302);
    }

    public function test_editing_a_class_logged_in_too_long_name() {
        $rooms = Room::all();
        $new_name = $this->generateRandomString(300);
        $room_id = $rooms[0]->id;

        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertSessionHasErrors(['name']);
        $response->assertStatus(302);
    }

    function generateRandomString($length) {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomString;
    }
}
