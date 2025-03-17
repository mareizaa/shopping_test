<?php

namespace App\Http\Controllers\Api;

use App\DTO\BuyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuyRequest;
use App\Http\Resources\BuyResource;
use App\Models\Buy;
use App\Repositories\BuyRepository;
use App\Services\BuyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BuyController extends Controller
{

    public function __construct(
        protected BuyService $buyService,
        protected BuyRepository $buyRepository
    )
    {}

    public function store(BuyRequest $request)
    {
        $buyDTO = BuyDTO::fromRequest($request->validated());

        $buy = $this->buyService->registerBuy($buyDTO);

        return response()->json([
            'message' => 'Compra registrada exitosamente',
            'buy' => $buy,
        ], 201);
    }

    public function show($id)
    {
        try {
            $buy = $this->buyRepository->findById($id);

            return new BuyResource($buy);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
