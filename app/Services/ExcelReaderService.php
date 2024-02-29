<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExcelReaderService
{

  /**
   * Get rows from an Excel file using storage path.
   *
   * @return LazyCollection
   */
  public function getRowsByStoragePath($path): LazyCollection
  {
    $filePath = Storage::path($path);
    return $this->getRowsFromFile($filePath);
  }

  /**
   * Get rows from an Excel file using file path.
   *
   * @param string $filePath
   * @return LazyCollection
   */
  public function getRowsByFilePath(string $filePath): LazyCollection
  {
    return $this->getRowsFromFile($filePath);
  }

  /**
   * Get rows from an Excel file.
   *
   * @param string $filePath
   * @return LazyCollection
   */
  protected function getRowsFromFile(string $filePath): LazyCollection
  {
    try {
      return SimpleExcelReader::create($filePath)->getRows();
    } catch (\Throwable $throwable) {
      // Handle any errors, such as file not found or unreadable
      // Log or throw an exception based on your application's requirements
      // For now, let's just return an empty LazyCollection
      return LazyCollection::make([]);
    }
  }

  /**
   * Add rows from an Excel file.
   *
   * @param string $filePath
   * @return LazyCollection
   */
  public static function addRowsFromFile($tempFile)
  {
    return SimpleExcelWriter::create($tempFile);
  }
}
