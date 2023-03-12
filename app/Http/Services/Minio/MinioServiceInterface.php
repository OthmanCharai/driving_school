<?php

namespace App\Http\Services\Minio;

use Illuminate\Http\Request;

interface MinioServiceInterface
{
    /**
     * @param Request $request
     * @param $folder
     * @return array
     */
    public function storeFile(Request $request,string $folder):array;

    /**
     * @param string $path
     * @return array
     */
    public function getFile(string $path):array;

    /**
     * @param Request $request
     * @param string $path
     * @param string $folder
     * @return array
     */
    public function updateFile(Request $request, string $path, string $folder):array;

    /**
     * @param $path
     * @return bool
     */
    public function deleteFile($path):bool;
}
