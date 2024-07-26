<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use App\Http\Resources\EventWithReservationsResource;
use App\Http\Resources\ReservationResource;

class EventController extends Controller
{

    public function index(Request $request)
    {

        $perPage = $request->get('per_page') ? $request->get('per_page') : 50;
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $sortDirection = $request->get('sort_direction') ? $request->get('sort_direction') : 'asc';

        $events = Event::where('date', '>=', now()->toDateString());
        // filter
        if ($request->get('name')) {
            $events = $events->whereName($request->get('name'));
        }
        if ($request->get('date')) {
            $events = $events->whereDate('date', $request->get('date'));
        }
        // sort
        if($sortBy == 'name') {
            $events = $events->orderByName($sortDirection);
        }
        else if($sortBy == 'date') {
            $events = $events->orderByDate($sortDirection);
        }



        $events = $events->paginate($perPage);
        return EventResource::collection($events);
    }

    public function show(Event $event)
    {
        return new EventWithReservationsResource($event);
    }

    public function create()
    {
    }

    public function store(StoreEventRequest $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->date = $request->date;
        $event->save();

        return new EventResource($event);
    }

    public function edit(Event $event)
    {
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->name = $request->name ?? $event->name;
        $event->date = $request->date ?? $event->date;
        $event->save();

        return new EventResource($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return new EventResource($event);
    }

    public function getUpcomingEvents()
    {
        $events = Event::where('date', '>', now())
            ->orderBy('date', 'asc')
            ->get();
        return EventResource::collection($events);
    }

    public function getReservations(Event $event)
    {
        return ReservationResource::collection($event->reservations);
    }
}
