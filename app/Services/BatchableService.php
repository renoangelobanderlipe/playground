<?php

namespace App\Services;

use Illuminate\Support\Facades\Bus;

class BatchableService
{

  public static function dispatchJobs($jobs)
  {
    $batch = Bus::batch($jobs)->dispatch();

    return $batch;
  }
}
