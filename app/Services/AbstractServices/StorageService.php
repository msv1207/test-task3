<?php

namespace App\Services\AbstractServices;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

abstract class StorageService
{
    protected string $basePath;
    protected string $diskName;

    protected Filesystem $storage;

    public function setStorage(string $diskName): self
    {
        $this->storage = Storage::disk($diskName);
        $this->diskName = $diskName;

        return $this;
    }

    public function setBasePath($basePath): self
    {
        $this->basePath = $basePath;

        return $this;
    }
}
