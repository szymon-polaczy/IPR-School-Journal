<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function editRoom(Room $room, Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|unique:room|max:255',
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $room->update($incomingFields);
        return redirect('dashboard');
    }

    public function deleteRoom(Room $room) {
        $room->delete();
        return redirect('dashboard');
    }

    public function createRoom(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|unique:class|max:255',
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Room::create($incomingFields);
        
        return redirect('dashboard');
    }
}
