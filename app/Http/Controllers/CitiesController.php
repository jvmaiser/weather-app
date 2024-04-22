<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCitiesRequest;
use App\Services\CitiesService;
use Illuminate\Http\JsonResponse;

/**
 * Controller responsible for handling requests related to cities.
 * @package App\Http\Controllers\CitiesController
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class CitiesController extends Controller
{
    /**
     * Constructor.
     * @param CitiesService $citiesService
     */
    public function __construct(
        protected CitiesService $citiesService,
    ) {
    }

    /**
     * Get a list of cities based on the provided search criteria.
     * @param SearchCitiesRequest $request
     * @return JsonResponse
     */
    public function getCities(SearchCitiesRequest $request): JsonResponse
    {
        $response = $this->citiesService->getCities($request->validated());
        return response()->json($response);
    }
}
