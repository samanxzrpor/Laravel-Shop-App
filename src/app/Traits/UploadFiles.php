<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFiles
{

    public function upload(UploadedFile $file , string $disk = 'public')
    {
        $filename = time().$file->getClientOriginalName();

        Storage::disk($disk)->putFileAs(
            '',
            $file,
            $filename
        );

        return $filename;
    }
}
