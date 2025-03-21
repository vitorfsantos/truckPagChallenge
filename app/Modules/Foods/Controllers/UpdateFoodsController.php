<?php

namespace App\Modules\Foods\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Foods\Requests\FoodsUpdateRequest;
use App\Modules\Foods\Services\UpdateFoodsService;

class UpdateFoodsController extends Controller
{
  public $updateService;

  public function __construct(UpdateFoodsService $updateService)
  {
    $this->updateService = $updateService;
  }

  public function update(FoodsUpdateRequest $request, $foodId)
  {
    $foods = $this->updateService->update($request->validated(), $foodId);
    return response(json_decode($foods->getContent(), true), $foods->getStatusCode());
  }
}
