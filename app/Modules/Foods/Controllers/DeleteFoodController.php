<?php

namespace App\Modules\Foods\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Foods\Services\DeleteFoodService;

class DeleteFoodController extends Controller
{
  public $deleteFood;

  public function __construct(DeleteFoodService $deleteFood)
  {
    $this->deleteFood = $deleteFood;
  }

  public function delete($foodId)
  {
    $foods = $this->deleteFood->delete($foodId);
    return response(json_decode($foods->getContent(), true), $foods->getStatusCode());
  }
}
