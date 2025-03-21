<?php

namespace App\Modules\Foods\Services;

use App\Modules\Foods\Models\Foods;
use Illuminate\Support\Facades\Artisan;

class GetFoodsService
{
  public $foods;

  public function __construct(Foods $foods)
  {
    $this->foods = $foods;
  }

  public function getAll()
  {
    Artisan::call('foods:daily_import');
    try {
      return response($this->foods->paginate(50));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
  public function getById($foodId)
  {
    try {
      return response($this->foods->find($foodId));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
