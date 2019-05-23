<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryAppProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\\Repositories\\Contracts\\IUserRepository', 'App\\Repositories\\Actions\UserRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IUserLevelRepository', 'App\\Repositories\\Actions\UserLevelRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IPositionRepository', 'App\\Repositories\\Actions\PositionRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IContingentRepository', 'App\\Repositories\\Actions\ContingentRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IParticipantRepository', 'App\\Repositories\\Actions\ParticipantRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IInformationRepository', 'App\\Repositories\\Actions\InformationRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IDownloadRepository', 'App\\Repositories\\Actions\DownloadRepository');
        $this->app->bind('App\\Repositories\\Contracts\\ITaskCategoriesRepository', 'App\\Repositories\\Actions\TaskCategoriesRepository');
        $this->app->bind('App\\Repositories\\Contracts\\ITasksRepository', 'App\\Repositories\\Actions\TasksRepository');
        $this->app->bind('App\\Repositories\\Contracts\\ISchedulesRepository', 'App\\Repositories\\Actions\SchedulesRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IParticipantTasksRepository', 'App\\Repositories\\Actions\ParticipantTasksRepository');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
