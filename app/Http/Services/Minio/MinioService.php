<?php

namespace App\Http\Services\Minio;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Psy\debug;

class MinioService implements MinioServiceInterface
{

    /**
     * @param Request $request
     * @param string $folder
     * @return array
     */
    public function storeFile(UploadedFile $file, string $folder): array
    {
        // TODO: Implement storeFile() method.
       $path=Storage::cloud()->putFile($folder,$file);
        return ['path'=>'WTFFF'];
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
    public function updateFile(UploadedFile $file, string $path, string $folder): array
    {
        // TODO: Implement updateFile() method.
        Storage::cloud()->delete($path);
        return $this->storeFile($file,$folder);
    }

    /**
     * @param $path
     * @return bool
     */
    public function deleteFile($path): bool
    {
        // TODO: Implement deleteFile() method.
       return Storage::cloud()->delete($path);

    }
    public function bulkStore(Request $request, $status,$folder): array
    {
        $data=[];
        // dd($request);
        $files=$request->file('images');
        // TODO: Implement bulkStore() method.
        foreach ($files as $key=>$index){
            $path=Storage::cloud()->putFile($folder,$index);

            $data[$key]=new Image([
                "url"=>$path,
                "status"=>($key==$status)?1:0,
            ]);
        }
        return $data;
    }
}
