<?php
use Illuminate\Support\Facades\File;

if (!function_exists('uploadImage')) {
    function uploadImage($file, $path = 'images', $oldFile = null)
    {
        if ($oldFile) {
            $oldFilePath = public_path($path) . '/' . $oldFile;
            if (File::exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);
        return $fileName;
    }
}
