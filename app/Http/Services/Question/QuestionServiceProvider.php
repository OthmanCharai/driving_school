<?php

namespace App\Http\Services\Question;

use App\Http\Services\Minio\MinioService;
use App\Http\Services\Minio\MinioServiceInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return string[]
     */
    public function provides():array
    {
        return [QuestionServiceInterface::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {

        $this->app->bind(
            QuestionServiceInterface::class,
            fn(Application $app)=>new QuestionService()
        );

    }

}
