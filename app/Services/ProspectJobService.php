<?php

namespace App\Services;

use App\Jobs\ProcessCsvDataJob;

class ProspectJobService
{
  /**
   * Run a job for processing a single CSV row.
   *
   * @param mixed $row
   * @return ProcessCsvDataJob
   */
  public static function runJob($row): ProcessCsvDataJob
  {
    return new ProcessCsvDataJob($row);
  }

  /**
   * Run jobs for processing multiple CSV rows and dispatch them in a batch.
   *
   * @param array $rows
   * @return mixed
   */
  public static function csvBatchJob($rows)
  {
    $jobs = [];

    foreach ($rows as $row) {
      $jobs[] = self::runJob($row);
    }

    return self::csvDispatchJobs($jobs);
  }

  /**
   * Dispatch jobs in a batch.
   *
   * @param array $jobs
   * @return mixed
   */
  public static function csvDispatchJobs($jobs)
  {
    return BatchableService::dispatchJobs($jobs);
  }
}
