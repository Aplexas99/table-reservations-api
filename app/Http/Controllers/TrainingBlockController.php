<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingBlock;
use App\Http\Requests\StoreTrainingBlockRequest;
use App\Http\Resources\TrainingBlockResource;

 class TrainingBlockController extends Controller
{
    
    public function getTrainingBlocksForClient($clientId)
    {
        $trainingBlocks = TrainingBlock::where('client_id', $clientId)
            ->where('end_date', '>', now())
            ->orWhereNull('end_date')
            ->get();

        return TrainingBlockResource::collection($trainingBlocks);
    }

    public function store(StoreTrainingBlockRequest $request)
    {
        $trainingBlock = TrainingBlock::create($request->validated());

        return new TrainingBlockResource($trainingBlock);
    }
}
