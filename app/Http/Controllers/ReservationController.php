<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room', 'user', 'extraServices', 'receipt'])
            ->latest()
            ->get();

        return response()->json($reservations);
    }

    public function filtered(Request $request)
    {
        $query = Reservation::with(['room', 'user', 'extraServices']);

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        if ($request->filled('start_date')) {
            $query->where('end_date', '>=', Carbon::parse($request->start_date));
        }

        if ($request->filled('end_date')) {
            $query->where('start_date', '<=', Carbon::parse($request->end_date));
        }

        $reservations = $query->get();

        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'user_id' => 'required|exists:users,user_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'comment' => 'nullable|string',
            'extra_services' => 'array',
            'extra_services.*' => 'exists:extra_services,extra_service_id',
        ]);

        $overlap = Reservation::where('room_id', $validated['room_id'])
            ->where(function ($q) use ($validated) {
                $q->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']]);
            })
            ->exists();

        if ($overlap) {
            return response()->json([
                'message' => 'Room is already booked for this period.'
            ], 422);
        }

        $reservation = Reservation::create([
            'room_id' => $validated['room_id'],
            'user_id' => $validated['user_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'comment' => $validated['comment'] ?? null,
        ]);

        if (!empty($validated['extra_services'])) {
            $reservation->extraServices()->sync($validated['extra_services']);
        }

        return response()->json($reservation->load(['room', 'extraServices']), 201);
    }

    public function show(Reservation $reservation)
    {
        return response()->json(
            $reservation->load(['room', 'user', 'extraServices', 'receipt'])
        );
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'comment' => 'nullable|string',
        ]);

        $reservation->update($validated);

        return response()->json($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->extraServices()->detach();
        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted']);
    }

    public function checkIn(Reservation $reservation)
    {
        if (now()->lt($reservation->start_date)) {
            return response()->json([
                'message' => 'Cannot check in before start date.'
            ], 422);
        }

        return response()->json(['message' => 'Checked in successfully']);
    }

    public function checkOut(Reservation $reservation)
    {
        if (now()->lt($reservation->start_date)) {
            return response()->json([
                'message' => 'Cannot check out before check-in period.'
            ], 422);
        }

        return response()->json(['message' => 'Checked out successfully']);
    }
}
