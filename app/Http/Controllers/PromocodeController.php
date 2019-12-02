<?php


namespace App\Http\Controllers;

use App\Exceptions\MaxCountUsePromocodeException;
use App\Http\Requests\Promocode\PromocodeGetRequest;
use App\Http\Requests\Promocode\PromocodeStoreRequest;
use App\Services\PromocodeService;
use Illuminate\Http\JsonResponse;

class PromocodeController extends Controller
{
    /**
     * @param PromocodeStoreRequest $request
     * @param PromocodeService $promocodeService
     * @return JsonResponse
     */
    public function store(PromocodeStoreRequest $request, PromocodeService $promocodeService)
    {
        $result = $promocodeService->genPromocode(
            $request->value,
            $request->max_use_count,
            $request->name
        );

        return $this->successResponse([
            'data' => $result->name
        ]);
    }

    /**
     * @param PromocodeGetRequest $request
     * @param PromocodeService $promocodeService
     * @return JsonResponse
     */
    public function get(PromocodeGetRequest $request, PromocodeService $promocodeService)
    {
        try {
            $result = $promocodeService->usePromocode(
                $request->name
            );
        } catch (MaxCountUsePromocodeException $e) {
            return $this->errorResponse([
                __('promocode.max_use'),
            ]);
        }

        return $this->successResponse([
            'data' => $result
        ]);
    }
}