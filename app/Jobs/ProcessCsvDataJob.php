<?php

namespace App\Jobs;

use App\Models\Prospect;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvDataJob implements ShouldQueue
{
  use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * The number of seconds after which the job's unique lock will be released.
   *
   * @var int
   */
  public $uniqueFor = 3600;

  protected $data;

  public function __construct($data)
  {
    $this->data = $data;
  }
  /**
   * Execute the job.
   */
  public function handle(): void
  {
    Prospect::create([
      'first_name' => $this->data['first_name'] ?? '',
      'last_name' => $this->data['last_name'] ?? '',
      'email' => $this->data['email'] ?? '',
    ]);
  }

  public function uniqueId(): string
  {
    return str()->uuid()->toString();
  }
}
