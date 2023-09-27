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

    public function test_creating_a_class_logged_in_not_admin() {
        $number_of_rooms = count(Room::all());
        $name = $this->generateRandomString(10);

        $users = User::role('teacher')->get();
        Auth::login($users[0]);

        $response = $this->post('/create-room', [
            'name' => $name,
        ]);

        $response->assertStatus(403);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertSame($number_of_rooms, $number_of_rooms_after_creation);

        Auth::logout();

        $users = User::role('student')->get();
        Auth::login($users[0]);

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
        $new_name = $this->generateRandomString(10);
        $room_id = collect(Room::first())->first();
        $room = Room::find($room_id);
        $og_name = $room->name;

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertStatus(403);

        $room = Room::find($room_id);
        $new_name = $room->name;

        $this->assertSame($og_name, $new_name);
    }

    public function test_editing_a_class_logged_in_not_admin() {
        $new_name = $this->generateRandomString(10);
        $room_id = collect(Room::first())->first();
        $room = Room::find($room_id);
        $og_name = $room->name;

        $users = User::role('teacher')->get();
        Auth::login($users[0]);

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertStatus(403);

        Auth::logout();

        $users = User::role('student')->get();
        Auth::login($users[0]);

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertStatus(403);

        $room = Room::find($room_id);
        $new_name = $room->name;

        $this->assertSame($og_name, $new_name);
    }

    public function test_editing_a_class_logged_in() {
        $new_name = $this->generateRandomString(10);
        $room_id = collect(Room::first())->first();
        $room = Room::find($room_id);
        $og_name = $room->name;

        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertStatus(302);

        $room = Room::find($room_id);
        $new_name = $room->name;

        $this->assertNotSame($og_name, $new_name);
    }

    public function test_editing_a_class_logged_in_too_long_name() {
        $new_name = $this->generateRandomString(300);
        $room_id = collect(Room::first())->first();
        $room = Room::find($room_id);
        $og_name = $room->name;

        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $response = $this->put('/edit-room/' . $room_id, [
            'name' => $new_name,
        ]);

        $response->assertSessionHasErrors(['name']);
        $response->assertStatus(302);

        $room = Room::find($room_id);
        $new_name = $room->name;

        $this->assertSame($og_name, $new_name);
    }


    public function test_deleting_a_class_not_logged_in() {
        $room_id = collect(Room::first())->first();

        $number_of_rooms = count(Room::all());

        $response = $this->delete('/delete-room/' . $room_id);

        $response->assertStatus(403);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertSame($number_of_rooms, $number_of_rooms_after_creation);
    }

    public function test_deleting_a_class_logged_in_not_admin() {
        $users = User::role('admin')->get();//Login as admin first to make sure we can create rooms
        Auth::login($users[0]);

        $number_of_rooms = count(Room::all());
        if ($number_of_rooms === 0) {
            $name = $this->generateRandomString(10);
            $response = $this->post('/create-room', [
                'name' => $name,
            ]);
        }

        Auth::logout();
        $users = User::role('teacher')->get();
        Auth::login($users[0]);

        $room_id = collect(Room::first())->first();
        $number_of_rooms = count(Room::all());

        $response = $this->delete('/delete-room/' . $room_id);

        $response->assertStatus(403);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertSame($number_of_rooms, $number_of_rooms_after_creation);


        Auth::logout();
        $users = User::role('student')->get();
        Auth::login($users[0]);

        $room_id = collect(Room::first())->first();
        $number_of_rooms = count(Room::all());

        $response = $this->delete('/delete-room/' . $room_id);

        $response->assertStatus(403);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertSame($number_of_rooms, $number_of_rooms_after_creation);
    }

    public function test_deleting_a_class_logged_in() {
        $users = User::role('admin')->get();
        Auth::login($users[0]);

        $number_of_rooms = count(Room::all());
        if ($number_of_rooms === 0) {
            $name = $this->generateRandomString(10);
            $response = $this->post('/create-room', [
                'name' => $name,
            ]);
        }

        $room_id = collect(Room::first())->first();
        $number_of_rooms = count(Room::all());

        $response = $this->delete('/delete-room/' . $room_id);

        $response->assertStatus(302);

        $number_of_rooms_after_creation = count(Room::all());

        $this->assertNotSame($number_of_rooms, $number_of_rooms_after_creation);
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
