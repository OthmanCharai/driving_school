<?php

namespace App\Http\Services\Minio;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MinioService implements MinioServiceInterface
{

    /**
     * @param Request $request
     * @param string $folder
     * @return array
     */
    public function storeFile(Request $request, string $folder): array
    {
        // TODO: Implement storeFile() method.
       $path=Storage::cloud()->putFile($folder,$request->file('image'));

        return ['path'=>$path];
    }

    /**
     * @param string $path
     * @return array
     */
    public function getFile(string $path):array
    {
        return [
            'url'=>Storage::cloud()->temporaryUrl($path,Carbon::now()->addHours(23))
        ];
    }
    /**
     * @param Request $request
     * @param string $path
     * @param string $folder
     * @return array
     */
    public function updateFile(Request $request, string $path, string $folder): array
    {
        // TODO: Implement updateFile() method.
        Storage::cloud()->delete($path);
        return $this->storeFile($request,$folder);
    }

    public function deleteFile($path): bool
    {
        // TODO: Implement deleteFile() method.
       return Storage::cloud()->delete($path);

    }
}
