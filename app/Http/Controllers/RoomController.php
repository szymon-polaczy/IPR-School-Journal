<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function editRoom(Room $room, Request $request) {
        //TODO: Who Can edit rooms

        $incomingFields = $request->validate([
            'name' => 'required|unique:room|max:255',
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $room->update($incomingFields);
        return redirect('dashboard');
    }

    public function deleteRoom(Room $room) {
        //TODO: Who Can delete rooms
        $room->delete();
        return redirect('dashboard');
    }

    public function createRoom(Request $request) {
        //TODO: Who Can create rooms

        $incomingFields = $request->validate([
            'name' => 'required|unique:class|max:255',
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Room::create($incomingFields);
        
        return redirect('dashboard');
    }
}
