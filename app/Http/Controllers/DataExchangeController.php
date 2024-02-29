<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCsvDataJob;
use App\Models\Prospect;
use App\Services\CsvLargeExportService;
use App\Services\ProspectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Spatie\Searchable\Search;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class DataExchangeController extends Controller
{
  public function upload(Request $request, ProspectService $prospectService)
  {
    try {
      $batchId = $prospectService->importProspects($request);

      return response()->json(['batch_id' => $batchId], 201);
    } catch (\Throwable $throwable) {
      return response()->json(['message' => $throwable->getMessage()], 500);
    }
  }

  public function export(Request $request, ProspectService $prospectService)
  {
    try {
      $data = $prospectService->exportProspects($request);
      dd($data);
      // 
    } catch (\Throwable $throwable) {
      return response()->json(['data' => $throwable->getMessage()]);
    }
  }

  public function status(Request $request)
  {
    $batch = null;

    if ($request->batch_id) {
      $batch = Bus::findBatch($request->batch_id);
    }

    return [
      'processedjob' => $batch->processedJobs(),
      'totalJobs' => $batch->totalJobs,
      'batch' => $batch,
      'percentage' => "{$batch->progress()} %",
    ];
  }
  public function test(Prospect $prospect)
  {
    return $prospect->queryJson();
  }
}
