<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Foods\Models\ImportsLogs;

Route::get('/', function () {

  $latestUrl = ImportsLogs::where('status', 'success')
      ->latest()
      ->first();

  $lastCronExecution = $latestUrl->created_at ?? null;
  return response()->json([
      'api_name' => env('APP_NAME', 'TruckPagChallenge'),
      'database' => [
          'read' => DB::connection()->getPdo() ? 'OK' : 'Erro',
          'write' => DB::transaction(fn() => true) ? 'OK' : 'Erro'
      ],
      'last_cron_execution' => $lastCronExecution,
      'uptime' => trim(shell_exec("uptime -p") ?: 'Indisponível'),
      'memory_usage' => round(memory_get_usage() / 1024 / 1024, 2) . ' MB',
  ]);
});

Route::group([], base_path('app/Modules/Foods/routes.php'));
