<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\TableResource;
use App\Http\Requests\Reservations\StoreReservationRequest;
use App\Http\Requests\Reservations\UpdateReservationRequest;
use App\Http\Resources\EventWithReservationsResource;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return ReservationResource::collection($reservations);
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function create()
    {
        $events = Event::where('date', '>', now())->get();
        $tables = Table::all();
        return [
            'data' => [
                'events' => EventWithReservationsResource::collection($events),
                'tables' => TableResource::collection($tables),
            ],
        ];
    }


    public function store(StoreReservationRequest $request)
    {
        $reservation = new Reservation();
        $reservation->table()->associate($request->table_id);
        $reservation->event()->associate($request->event_id);
        $reservation->reserved_by = $request->reserved_by;
        $reservation->instagram_link = $request->instagram_link;

        $reservation->save();

        return new ReservationResource($reservation);
    }

    public function edit(Reservation $reservation)
    {
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->table()->associate($request->table_id ?? $reservation->table_id);
        $reservation->event()->associate($request->event_id ?? $reservation->event_id);
        $reservation->reserved_by = $request->reserved_by ?? $reservation->reserved_by;
        $reservation->instagram_link = $request->instagram_link ?? $reservation->instagram_link;

        $reservation->save();

        return new ReservationResource($reservation);
    }
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return new ReservationResource($reservation);
    }

    private function getInstagramProfilePicture($instagramLink)
    {
        // Implementirajte dohvaćanje slike profila s Instagrama koristeći API
        return null; // Zamijenite stvarnom logikom
    }
}

