<?php

namespace App\Console\Commands;

use App\Modules\Foods\Models\ImportsLogs;
use App\Modules\Foods\Services\CreateFoodService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Log;

class FoodsDataImportation extends Command
{
  protected $signature = 'foods:daily_import';

  protected $description = 'Busca por alimentos da api Open Food Facts e registra no banco de dados da aplicação.';

  private $createFoodService;
  private $url;


  public function __construct(CreateFoodService $createFoodService)
  {
    parent::__construct();
    $this->createFoodService = $createFoodService;

    $latestUrl = ImportsLogs::where('status', 'success')
      ->latest()
      ->first();

    if ($latestUrl) {
      $newUrl = preg_replace_callback('/products_(\d+)/', function ($matches) {
        $number = (int) $matches[1];
        $newNumber = str_pad($number + 1, 2, '0', STR_PAD_LEFT);
        return 'products_' . $newNumber;
      }, $latestUrl->file_name);
    }
    $this->url = $newUrl ?? 'https://challenges.coode.sh/food/data/json/products_01.json.gz';
  }

  public function handle()
  {
    try {
      DB::beginTransaction();
      $path = Storage::path('temp/file.json.gz');
      $uncompressedPath = storage_path('app/temp/file.json');

      $response = Http::get($this->url);
      if (!$response->successful()) {
        abort(500);
      }

      $import = $this->createFoodService->createLog([
        "status" => "success",
        "file_name" => $this->url
      ]);

      Storage::makeDirectory('temp');
      Storage::put('temp/file.json.gz', $response->body());

      $gzFile = gzopen($path, 'r');

      if (!$gzFile) {
        $this->error('Erro ao abrir o arquivo .gz');
        return;
      }

      $itensCount = 0;

      while (!gzeof($gzFile) && $itensCount < 100) {
        $tableItem = gzgets($gzFile);

        if ($tableItem) {
          $json = json_decode($tableItem, true);

          if ($json) {
            $json['import_id'] = $import->id;
            $this->createFoodService->importFood($json);
            $itensCount++;
          }
        }
      }

      gzclose($gzFile);



      DB::commit();
    } catch (\Throwable $th) {
      $this->createFoodService->createLog([
        "status" => "failure",
        "file_name" => $this->url
      ]);
      DB::commit();
      throw $th;
    }
  }
}
