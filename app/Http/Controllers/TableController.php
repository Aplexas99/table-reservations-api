<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Resources\TableResource;

class TableController extends Controller
{
    public function index()
    {
        $redTables = Table::where('zone', 'Red zone')->limit(96)->get();
        $vipTables = Table::where('zone', 'Vip zone')->limit(7)->get();

        return [
            'data' => [
                'red_tables' => TableResource::collection($redTables),
                'vip_tables' => TableResource::collection($vipTables),
            ],
        ];
    }
}
