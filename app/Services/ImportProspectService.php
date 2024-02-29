<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImportProspectService
{
  protected FileStorageService $fileService;

  public function __construct(FileStorageService $fileService)
  {
    $this->fileService = $fileService;
  }

  /**
   * Upload a file and return the stored path.
   *
   * @param Request $request
   * @param string $fileName
   * @return string|null
   */
  public function uploadFile(Request $request, string $fileName): ?string
  {
    $file = $request->file($fileName);

    if (!$file) {
      return null; // File not found in request
    }

    return $this->fileService->upload($file);
  }

  /**
   * Upload a file and return the stored path if successful.
   *
   * @param Request $request
   * @param string $fileName
   * @return string|null
   */
  public function uploadValidatedFile(Request $request, string $fileName): ?string
  {
    $file = $request->file($fileName);

    if (!$file || !$file->isValid()) {
      return null; // File is not valid
    }

    return $this->fileService->upload($file);
  }
}
