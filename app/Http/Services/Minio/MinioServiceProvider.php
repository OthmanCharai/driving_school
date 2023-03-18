<?php

namespace App\Http\Services\Minio;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;


class MinioServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return string[]
     */
    public function provides():array
    {
        return [MinioServiceInterface::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {

        $this->app->bind(
            MinioServiceInterface::class,
            fn(Application $app)=>new MinioService()
        );

    }




}
