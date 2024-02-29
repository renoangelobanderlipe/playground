<?php

namespace App\Services;

use App\Models\Prospect;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ProspectExportService
{
  protected $columns;
  protected $fileName;
  protected $limit;
  protected $chunkSize = 1000;
  protected $fileType;

  public function __construct($columns, $fileName, $limit = 1000, $fileType = 'csv')
  {
    $this->columns = $columns;
    $this->fileName = $fileName;
    $this->limit = $limit;
    $this->fileType = $fileType;
  }

  public static function exportAndDownload($columns, $fileName, $limit = 1000, $fileType = 'csv')
  {
    $service = new self($columns, $fileName, $limit, $fileType);
    $filePath = $service->export();
    return $service->download($filePath);
  }

  protected function export()
  {
    $tempFile = FileStorageService::temporaryFile($this->fileName);

    $writer = SimpleExcelWriter::create($tempFile);

    $prospects = $this->getProspectsData();

    foreach ($prospects as $prospect) {
      $this->insertRowData($writer, $prospect);
    }

    $writer->close();

    return $tempFile;
  }

  protected function getProspectsData()
  {
    return (new Prospect)->largeExport([
      'columns' => $this->columns ?? '*',
      'limit' => $this->limit ?? config('prospects.limit'),
      'chunkSize' => $this->chunkSize ?? config('prospects.limit'),
    ])->chunk($this->chunkSize);
  }

  protected function insertRowData(SimpleExcelWriter $writer, $prospects)
  {
    foreach ($prospects as $prospect) {
      $writer->addRow($prospect->toArray());
    }
  }

  protected function download($filePath)
  {
    return response()->download($filePath, $this->fileName, [
      'Content-Type' => 'application/octet-stream',
      'Content-Disposition' => 'attachment; filename="' . $this->fileName . '"',
    ])->deleteFileAfterSend(true);
  }
}
