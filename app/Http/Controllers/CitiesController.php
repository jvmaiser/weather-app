<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCitiesRequest;
use App\Services\CitiesService;
use Illuminate\Http\JsonResponse;

class CitiesController extends Controller
{
    public function __construct(
        protected CitiesService $citiesService,
    ) {
    }

    public function getCities(SearchCitiesRequest $request): JsonResponse
    {
        $response = $this->citiesService->getCities($request->validated());
        return response()->json($response);
    }
}
