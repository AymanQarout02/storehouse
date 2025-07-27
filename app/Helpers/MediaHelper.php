<?php

use App\Models\Media;
if (!function_exists('uploadMedia')) {
    function uploadMedia($file, $folder = 'products', $disk = 'public'){

        $filePath = $file->store($folder, $disk);


        $media = Media::create([
            'file_name'  => $file->getClientOriginalName(),
            'file_path'  => $filePath,
            'file_type'  => $file->getClientMimeType(),
            'file_size'  => $file->getSize(),
            'created_by' => auth()->id(),
        ]);

        return $media->id;

    }
}
