<?php

namespace App\Http\Services\Minio;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface MinioServiceInterface
{
    /**
     * @param UploadedFile $file
     * @param string $folder
     * @return array
     */
    public function storeFile(UploadedFile $file,string $folder):array;

    /**
     * @param string $path
     * @return array
     */
    public function getFile(string $path):array;

    /**
     * @param UploadedFile $file
     * @param string $path
     * @param string $folder
     * @return array
     */
    public function updateFile(UploadedFile $file, string $path, string $folder):array;

    /**
     * @param $path
     * @return bool
     */
    public function deleteFile($path):bool;

    /**
     * @param Request $request
     * @param $index
     * @return array
     */
    public function bulkStore(Request $request,int $status,string $folder):array;

}
