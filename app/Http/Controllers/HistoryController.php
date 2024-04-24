<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\HistoryService;
use Illuminate\Http\Request;
use Inertia\Response;
use Illuminate\Http\JsonResponse;

class HistoryController extends Controller
{
    /**
     * @param  HistoryService  $service
     */
    public function __construct(HistoryService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function game(Request $request): JsonResponse
    {
        return response()->json($this->service->createNew(auth()->user()));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function last_games(Request $request): JsonResponse
    {
        return response()->json($this->service->lastItems(auth()->user()));
    }
}
