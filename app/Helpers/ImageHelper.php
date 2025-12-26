<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Compress and save image using GD library
     * 
     * @param UploadedFile $file
     * @param string $folder
     * @param int $quality (1-100, lower = smaller file)
     * @param int|null $maxWidth Maximum width in pixels (null = no resize)
     * @return string Path to saved image
     */
    public static function compressAndStore(UploadedFile $file, string $folder = 'reports', int $quality = 75, ?int $maxWidth = 1920): string
    {
        // Check if GD is available
        if (!function_exists('imagecreatefromjpeg')) {
            // GD not available, store original
            return $file->store($folder, 'public');
        }

        try {
            return self::compressWithGD($file, $folder, $quality, $maxWidth);
        } catch (\Exception $e) {
            // If compression fails, just store original file
            \Log::error('Image compression failed: ' . $e->getMessage());
            return $file->store($folder, 'public');
        }
    }

    /**
     * Compress image using GD library (PHP native)
     */
    private static function compressWithGD(UploadedFile $file, string $folder, int $quality, ?int $maxWidth): string
    {
        // Get image info
        $imageInfo = getimagesize($file->getRealPath());
        if (!$imageInfo) {
            // If not a valid image, just store as is
            return $file->store($folder, 'public');
        }
        
        list($width, $height, $type) = $imageInfo;
        
        // Create image resource based on type
        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($file->getRealPath());
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($file->getRealPath());
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($file->getRealPath());
                break;
            default:
                // Unsupported type, store as is
                return $file->store($folder, 'public');
        }
        
        // Calculate new dimensions if needed
        $newWidth = $width;
        $newHeight = $height;
        
        if ($maxWidth && $width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int)($height * ($maxWidth / $width));
        }
        
        // Create new image with new dimensions
        $destination = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preserve transparency for PNG
        if ($type == IMAGETYPE_PNG) {
            imagealphablending($destination, false);
            imagesavealpha($destination, true);
            $transparent = imagecolorallocatealpha($destination, 255, 255, 255, 127);
            imagefilledrectangle($destination, 0, 0, $newWidth, $newHeight, $transparent);
        }
        
        // Resize image
        imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.jpg';
        $path = $folder . '/' . $filename;
        $fullPath = storage_path('app/public/' . $path);
        
        // Create directory if not exists
        $dir = dirname($fullPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        // Save as JPEG (best compression)
        imagejpeg($destination, $fullPath, $quality);
        
        // Free memory
        imagedestroy($source);
        imagedestroy($destination);
        
        return $path;
    }
}

