<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $fileUrl;
    private $destinationPath;

    public function __construct(string $fileUrl, string $destinationPath)
    {
        $this->fileUrl = $fileUrl;
        $this->destinationPath = $destinationPath;
    }

    public function handle()
    {
        $fileContent = file_get_contents($this->fileUrl);

        Storage::append($this->destinationPath, $fileContent);
    }
}

