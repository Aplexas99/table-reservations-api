<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoachClientRequest;
use App\Http\Requests\UpdateCoachClientRequest;
use App\Models\CoachClient;
use App\Http\Resources\CoachClientResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class CoachClientController extends Controller
{
    public function getClientsForCoach(Request $request, $coachId)
    {
        $perPage = $request->get('per_page') ? $request->get('per_page') : 50;
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'id';
        $sortDirection = $request->get('sort_direction') ? $request->get('sort_direction') : 'asc';

        $clients = CoachClient::query();

        /** Sorts */
        if($request->has('sort_by')) {
            $clients->orderBy($sortBy, $sortDirection);
        }

        $clients = CoachClient::where('coach_id', $coachId)
                ->with('client');
            //->where('end_date', ">", now()) 
            //Maybe it is better to show all clients, even if the end_date is in the past
            //and let the coach decide if he wants to keep the client or not
            //Expired clients can be filtered out in the frontend if needed and will have
            //red color or something to indicate that they are expired
        
        $clients = $clients->paginate($perPage);

        return [
            'data' => UserResource::collection($clients->pluck('client')),
            'meta' => [
                'current_page' => $clients->currentPage(),
                'last_page' => $clients->lastPage(),
                'per_page' => $clients->perPage(),
                'total' => $clients->total(),
            ],
        ];
    }
}
