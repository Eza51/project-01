<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Exception;
use Illuminate\Http\JsonResponse;

class CountryStateCity extends Controller
{
    /**
     * @return JsonResponse
     */
    public function countries(): JsonResponse
    {
        try {
            $result = Country::query()
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Query Successfully',
                'data' => $result,
                'error' => null,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Query Failed',
                'data' => null,
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ]);
        }
    }

    /**
     * @param int|null $countryId
     * @return JsonResponse
     */
    public function states(int $countryId = null): JsonResponse
    {
        try {
            $query = State::query();
            $query->orderBy('name');

            if ($countryId) {
                $query->where('country_id', '=', $countryId);
            }

            return response()->json([
                'success' => true,
                'message' => 'Query Successfully',
                'data' => $query->get(),
                'error' => null,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Query Failed',
                'data' => null,
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ]);
        }
    }

    /**
     * @param int|null $stateId
     * @return JsonResponse
     */
    public function cities(int $stateId = null): JsonResponse
    {
        try {
            $query = City::query();
            $query->orderBy('name');

            if ($stateId) {
                $query->where('state_id', '=', $stateId);
            }

            return response()->json([
                'success' => true,
                'message' => 'Query Successfully',
                'data' => $query->get(),
                'error' => null,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Query Failed',
                'data' => null,
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ]);
        }
    }
}
