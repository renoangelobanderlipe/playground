<?php

namespace App\Services;

use App\Models\Prospect;
use Illuminate\Http\Request;
use App\Jobs\ProcessCsvDataJob;
use Illuminate\Support\Facades\Storage;

class ProspectService
{
  protected ImportProspectService $importProspectService;

  public function __construct(ImportProspectService $importProspectService)
  {
    $this->importProspectService = $importProspectService;
  }

  /**
   * importing the prospects to the database
   *
   * @param Request $request
   * @return void
   */
  public function importProspects(Request $request)
  {
    // storing the file uploaded temporarily
    $path = $this->importProspectService->uploadValidatedFile($request, 'prospects');

    // get rows from ExcelReader
    $rows = (new ExcelReaderService)->getRowsByStoragePath($path);

    // return the Batch Dispatch Jobs
    $batch =  ProspectJobService::csvBatchJob($rows);

    // FileStorageService::deleteFile($path);
    return $batch->id;
  }

  public function exportProspects(Request $request)
  {
    return ProspectExportService::exportAndDownload(
      $request->query('columns'),
      'prospects_data',
      $request->query('limit')
    );
  }
}
