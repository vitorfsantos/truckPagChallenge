<?php

namespace App\Modules\Foods\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foods extends Model
{
  use HasFactory, HasUuids, SoftDeletes;

  protected $table = 'foods';

  const CREATED_AT = 'imported_t';

  protected $fillable = [
    'import_id',
    'code',
    'status',
    'url',
    'creator',
    'created_t',
    'last_modified_t',
    'product_name',
    'quantity',
    'brands',
    'categories',
    'labels',
    'cities',
    'purchase_places',
    'stores',
    'ingredients_text',
    'traces',
    'serving_size',
    'serving_quantity',
    'nutriscore_score',
    'nutriscore_grade',
    'main_category',
    'image_url',
    'imported_t',
  ];

  protected $dates = ['imported_t', 'deleted_at'];

  public function setAttribute($key, $value)
  {
    if (in_array($key, ['nutriscore_score', 'serving_quantity']) && $value === "") {
      $value = null;
    }

    parent::setAttribute($key, $value);
  }

  public function importLog()
  {
    return $this->belongsTo(ImportsLogs::class, 'import_id');
  }
}
