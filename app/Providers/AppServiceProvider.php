<?php

namespace App\Providers;

use App\Repositories\CursoRatingRepository;
use App\Repositories\DbInstructorRepository;
use App\Repositories\Eloquent\EloquentCursoRatingRepository;
use App\Repositories\InstructorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            CursoRatingRepository::class,
            EloquentCursoRatingRepository::class
        );

        $this->app->bind(InstructorRepository::class, DbInstructorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
