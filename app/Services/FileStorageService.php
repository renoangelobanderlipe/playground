<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileStorageService
{
  /**
   * Upload a file and return the stored path.
   *
   * @param UploadedFile $file
   * @param string $directory
   * @return string|null
   */
  public function upload(UploadedFile $file, string $directory = 'uploads'): ?string
  {
    // Ensure the directory exists
    if (!is_dir($directory)) {
      mkdir($directory, 0755, true);
    }

    // Generate a unique file name
    $fileName = $file->hashName();

    // Store the file
    if ($file->storeAs($directory, $fileName)) {
      return $directory . '/' . $fileName;
    }

    return null;
  }


  public static function temporaryFile(string $fileName, $type = 'csv')
  {
    return tempnam(sys_get_temp_dir(), $fileName) . '.' . $type;
  }

  /**
   * Delete a file from storage.
   *
   * @param string $path
   * @return bool
   */
  public static function deleteFile(string $path): bool
  {
    if (Storage::exists($path)) {
      return Storage::delete($path);
    }

    return false; // File doesn't exist or unable to delete
  }
}
