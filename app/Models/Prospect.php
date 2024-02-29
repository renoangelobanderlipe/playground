<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prospect extends Model
{
  use HasFactory;

  protected $table = 'prospects';
  protected $guarded = [];
  protected $casts = [
    'meta' => 'array'
  ];
  public function queryJson()
  {
    $columns = [
      'job_title', 'company_name', 'email_status', 'personal_email'
    ];
    $metas = self::select(['id', 'meta'])->limit(1000)->get()->toArray();

    $filteredMeta = [];
    $temp = [];

    foreach ($metas as $meta) {
      $filteredMeta['id'] = $meta['id'];
      // $filteredMeta['id'] = $meta['id'];
      $filteredMeta['values'] = collect($meta['meta'])->whereIn('field_name', $columns)->toArray();

      $temp[] = $filteredMeta;
    }

    return $temp;
  }

  protected function scopeExportLargeCsvData(Builder $query, array $options)
  {
    $defaultOptions = [
      'limit' => $options['limit'] ?? 1000,
      'columns' =>  empty($options['columns']) ? config('prospects.requiredFields') : explode(',', $options['columns']),
    ];

    $prefixedColumns = array_map(function ($column) {
      return 'prospects.' . $column;
    }, $defaultOptions['columns']);

    $query->select([
      'id',
      ...$prefixedColumns
      // \DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by")
    ])
      // ->join('users', 'users.id', 'prospects.created_by')
      ->limit($defaultOptions['limit']);
  }

  public function largeExport(array $options)
  {
    return  self::exportLargeCsvData($options)->get();
    // $columns = convertArrayKeysToTitleCase(array_keys($prospects->first()->toArray()));

    // return [
    //   'data' => $prospects,
    //   'columns' => $columns
    // ];
  }
}
