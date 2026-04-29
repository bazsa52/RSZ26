<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomStateEnum;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['pictures', 'stateLog.state'])->get();

        return response()->json($rooms);
    }

    public function availableForBooking()
    {
        $rooms = Room::with(['stateLog.state', 'pictures'])
            ->get()
            ->filter(function ($room) {
                return $room->state() === RoomStateEnum::Available;
            })
            ->values();

        return response()->json($rooms);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|integer|min:0',
        ]);

        $room = Room::create($validated);

        return response()->json($room, 201);
    }

    public function show(Room $room)
    {
        $room->load(['pictures', 'stateLog.state', 'reservations']);

        return response()->json($room);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|nullable|string',
            'capacity' => 'sometimes|integer|min:1',
            'price_per_night' => 'sometimes|integer|min:0',
        ]);

        $room->update($validated);

        return response()->json($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json(['message' => 'Room deleted']);
    }
}
