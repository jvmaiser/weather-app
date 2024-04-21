<?php

namespace App\Http\Controllers;

use App\Services\CitiesService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CitiesController extends Controller
{
    public function __construct(
        protected CitiesService $citiesService,
    ) {
    }

    public function getCities(Request $request): JsonResponse
    {
        $response = $this->citiesService->getCities($request->all());
        return response()->json($response);
    }
}
