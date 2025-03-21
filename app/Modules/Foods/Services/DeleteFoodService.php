<?php

namespace App\Modules\Foods\Services;

use App\Modules\Foods\Models\Foods;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DeleteFoodService
{
  public $foods;

  public function __construct(Foods $foods)
  {
    $this->foods = $foods;
  }

  public function delete($foodId)
  {
    try {
      DB::beginTransaction();
      $food = $this->foods->find($foodId);
      if (!$food) return response(["message" => "Registro não encontrado"], 400);

      $food->delete();

      DB::commit();
      return response('', 204);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }
}
