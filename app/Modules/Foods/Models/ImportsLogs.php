<?php

namespace App\Modules\Foods\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ImportsLogs extends Model
{
  use HasFactory, HasUuids;

  protected $table = 'imports_logs';

  protected $primaryKey = 'id';
  // public $incrementing = false;
  // protected $keyType = 'string';

  protected $fillable = [
    'status',
    'file_name',
  ];

  public function importLog()
  {
    return $this->hasMany(Foods::class, 'import_id');
  }
}
