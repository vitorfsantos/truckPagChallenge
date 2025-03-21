<?php

namespace App\Modules\Foods\Services;

use App\Modules\Foods\Models\Foods;
use App\Modules\Foods\Models\ImportsLogs;
use Illuminate\Support\Facades\DB;

class CreateFoodService
{
  public $foods;

  public function __construct(Foods $foods)
  {
    $this->foods = $foods;
  }

  public function importFood($food)
  {
    try {
      DB::beginTransaction();
      $this->foods->create($food);

      DB::commit();
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function createLog($log)
  {
    try {
      DB::beginTransaction();
      $log = ImportsLogs::create($log);

      DB::commit();
      return $log;
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
