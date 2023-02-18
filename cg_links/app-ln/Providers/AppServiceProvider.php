<?php

namespace App\Providers;

use App\Services\BladeDirectives;
use Barryvdh\Debugbar\Facade as DebugbarFacade;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Way\Generators\GeneratorsServiceProvider;
use Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider;

use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(BladeDirectives $directives)
    {
      $directives->register();
      
      Relation::morphMap([
        'ad' => 'App\Ad',
        'article' => 'App\Article',
        'article-read' => 'App\Article',
        'article-contact' => 'App\Article',
        'event' => 'App\Event',
        'job' => 'App\Job',
        'release' => 'App\Release',
        'video' => 'App\Video',
      ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');

            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DebugbarServiceProvider::class);

            $this->app->register(GeneratorsServiceProvider::class);
            $this->app->register(MigrationsGeneratorServiceProvider::class);

            $this->app->alias('Debugbar', DebugbarFacade::class);

            $this->app->useDatabasePath(base_path('database/working'));

        }
    }
}
