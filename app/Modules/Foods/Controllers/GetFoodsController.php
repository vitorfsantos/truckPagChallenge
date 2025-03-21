<?php

namespace App\Modules\Foods\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Foods\Services\GetFoodsService;
use App\Modules\WhatsApp\Services\Get;

class GetFoodsController extends Controller
{
  public $getService;

  public function __construct(GetFoodsService $getService)
  {
    $this->getService = $getService;
  }

  public function getAll()
  {
    $foods = $this->getService->getAll();
    return response(json_decode($foods->getContent(), true), $foods->getStatusCode());
  }
  public function getById($foodId)
  {
    $foods = $this->getService->getById($foodId);
    return response(json_decode($foods->getContent(), true), $foods->getStatusCode());
  }

}
