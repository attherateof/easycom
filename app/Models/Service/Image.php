<?php

namespace App\Models\Service;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Image
{
    private const DEFAULT_STORAGE_PATH = 'gallery';

    private ?string $base64Image = null;
    private ?string $storagePath = null;

    public function setImageString(string $base64Image): self
    {
        $this->base64Image = $base64Image;
        return $this;
    }

    public function setStoragePath(string $storagePath): self
    {
        $this->storagePath = $storagePath;
        return $this;
    }

    public function save(): string
    {
        $base64ImageString = $this->getImageString();
        list($mimeType, $data) = $this->extractMimeTypeAndData($base64ImageString);
        $imageData = $this->decodeBase64Data($data);
        $fileName = $this->generateFileName($mimeType);
        $path = $this->getStoragePath() . '/' . $fileName;
        $this->storeImage($path, $imageData);

        return 'storage/' . $path;
    }

    public function delete(string $path): void
    {
        $substring = $this->getRelativePath($path);

        if ($substring) {
            $this->deleteFile($substring);
        } else {
            Log::error("Relative path not exists");
        }
    }

    private function getImageString(): string
    {
        if (!$this->base64Image) {
            throw new InvalidArgumentException('Base64 image string must be provided.');
        }

        return $this->base64Image;
    }

    private function extractMimeTypeAndData(string $base64ImageString): array
    {
        list($mimeType, $data) = explode(';', $base64ImageString);

        return [
            preg_replace('/^data:/', '', $mimeType),
            preg_replace('/^base64,/', '', $data)
        ];
    }

    private function decodeBase64Data(string $data): string
    {
        return base64_decode($data);
    }

    private function generateFileName(string $mimeType): string
    {
        $currentTime = Carbon::now()->unix();
        $extension = preg_replace('/^image\//', '', $mimeType);
        return uniqid('image_') . $currentTime . '.' . $extension;
    }

    private function storeImage(string $path, string $imageData): void
    {
        Storage::disk('public')->put($path, $imageData);
    }

    private function getStoragePath(): string
    {
        return $this->storagePath ?: self::DEFAULT_STORAGE_PATH;
    }

    private function getRelativePath(string $path): ?string
    {
        $searchTerm = 'storage/';
        $substring = strstr($path, $searchTerm);

        if ($substring !== false) {
            $offset = strlen($searchTerm);
            return substr($substring, $offset);
        } else {
            return null;
        }
    }

    private function deleteFile(string $path): void
    {
        Storage::disk('public')->delete($path);
    }
}
