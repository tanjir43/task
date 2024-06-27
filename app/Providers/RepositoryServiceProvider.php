<?php

namespace App\Providers;

use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Eloquents\FrontendArticleRepository;
use App\Repositories\Eloquents\UniversityRepository;
use App\Repositories\Eloquents\UniversitySubjectRepository;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Interfaces\FrontendArticleRepositoryInterface;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use App\Repositories\Interfaces\UniversitySubjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UniversityRepositoryInterface::class, UniversityRepository::class);
        $this->app->bind(UniversitySubjectRepositoryInterface::class, UniversitySubjectRepository::class);
        $this->app->bind(FrontendArticleRepositoryInterface::class, FrontendArticleRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
