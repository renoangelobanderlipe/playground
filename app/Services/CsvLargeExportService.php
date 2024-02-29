<?php

namespace App\Services;

use Spatie\SimpleExcel\SimpleExcelWriter;

class CsvLargeExportService
{
  public static function export($data, $headers = [], $fileName = 'export.csv', $chunkSize = 10000)
  {
    // Create a temporary file to store CSV data
    $tempFile = tempnam(sys_get_temp_dir(), $fileName);

    // Ensure that the file extension is '.csv'
    $tempFile = $tempFile . '.csv';

    // Create a SimpleExcelWriter instance
    $writer = SimpleExcelWriter::create($tempFile);
    // Add headers to the CSV file
    $writer->addRow($headers);

    // Export data in chunks
    foreach ($data->chunk($chunkSize) as $chunk) {
      foreach ($chunk as $row) {
        $writer->addRow($row->toArray());
      }
    }

    // Close the writer
    $writer->close();

    // Return the path to the temporary file
    return $tempFile;
  }
}
