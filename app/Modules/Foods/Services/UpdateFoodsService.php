<?php

namespace App\Modules\Foods\Services;

use App\Modules\Foods\Models\Foods;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UpdateFoodsService
{
  public $foods;

  public function __construct(Foods $foods)
  {
    $this->foods = $foods;
  }

  public function update($request, $foodId)
  {
    try {
      DB::beginTransaction();
      $food = $this->foods->find($foodId);
      if (!$food) return response(["message" => "Registro não encontrado"], 400);

      $food->update($request);

      DB::commit();
      return response($food, 200);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }
}
