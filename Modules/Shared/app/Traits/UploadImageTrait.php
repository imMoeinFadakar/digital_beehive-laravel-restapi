<?php

namespace Modules\Shared\Traits;

use Illuminate\Support\Facades\Log;

trait UploadImageTrait
{
const ABSOLUTE_UPLOAD_PATH = 'D:/Copy/koohpaie_IT/digital_beehive/public/upload';
const CDN_URL = 'http://127.0.0.1:8000/upload/';


    public function uploadMedia($request, $dirName, $index = 'image', $oldPath = null)
    {
        // لاگ برای بررسی وجود فایل
        if (!$request->hasFile($index)) {
            Log::warning("No file found in request under key '$index'");
            return null;
        }
        
        $file = $request->file($index);
        
        
        
        
        $fileName = $this->generateFileName($file);
        $uploadPath = self::ABSOLUTE_UPLOAD_PATH . $dirName;
        
        // بررسی وجود پوشه مقصد
        if (!file_exists($uploadPath)) {
            Log::error("Upload path does not exist: $uploadPath. Create it manually with correct permissions.");
            return null;
        }
        dd("file nist");

        // حذف فایل قبلی در صورت وجود
        $this->deleteOldFileIfExists($oldPath);

        // انتقال فایل به مسیر
        try {
            $file->move($uploadPath, $fileName);
        } catch (\Exception $e) {
            Log::error("Failed to move uploaded file: " . $e->getMessage());
            return null;
        }

        // مسیر نهایی CDN
        return self::CDN_URL . "$dirName/$fileName";
    }

    private function generateFileName($file)
    {
        return uniqid() . rand(10, 999) . now()->microsecond . '.' . $file->extension();
    }

    private function deleteOldFileIfExists($oldUrl)
    {
        if (!$oldUrl) return;

        $relative = str_replace(self::CDN_URL, '', $oldUrl);
        $filePath = self::ABSOLUTE_UPLOAD_PATH . $relative;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

