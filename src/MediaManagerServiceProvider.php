<?php

namespace Asperhsu\LaravelMediaManager;

use Illuminate\Support\ServiceProvider;

class MediaManagerServiceProvider extends ServiceProvider
{
    protected $vendorDir;
    protected $publicPath = 'assets/vendor/MediaManager';

    public function __construct()
    {
        $this->vendorDir = realpath(__DIR__ . '/../ctf0/media-manager/src/');
    }

    public function boot()
    {
        $this->viewCompose();

        if ($this->app->runningInConsole()) {
            $this->packagePublish();
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom($this->vendorDir . '/config/mediaManager.php', 'mediaManager');
    }

    protected function packagePublish()
    {
        // config
        $this->publishes([
            $this->vendorDir . '/config' => config_path(),
        ], 'config');

        // database
        $this->publishes([
            $this->vendorDir . '/database/MediaManager.sqlite' => database_path('MediaManager.sqlite'),
        ], 'db');

        $this->loadMigrationsFrom($this->vendorDir . '/database/migrations');
        $this->publishes([
            $this->vendorDir . '/database/migrations' => database_path('migrations'),
        ], 'migration');

        // trans
        $this->loadTranslationsFrom($this->vendorDir . '/resources/lang', 'MediaManager');
        $this->publishes([
            $this->vendorDir . '/resources/lang' => resource_path('lang/vendor/MediaManager'),
        ], 'trans');

        // views
        $this->loadViewsFrom($this->vendorDir . '/resources/views', 'MediaManager');
        $this->publishes([
            $this->vendorDir . '/resources/views' => resource_path('views/vendor/MediaManager'),
        ], 'view');

        // resources
        $this->publishes([
            __DIR__ . '/resources/assets' => resource_path('assets/vendor/MediaManager'),
        ], 'assets');

        // public
        $this->publishes([
            __DIR__ . '/../public' => public_path($this->publicPath),
        ], 'public');
    }

    protected function viewCompose()
    {
        $config = $this->app['config']->get('mediaManager');
        if (!$config) {
            return;
        }

        $data = [];
        $this->file = $this->app['files'];

        $url = $this->app['filesystem']->disk($config['storage_disk'])->url('/');
        $data['base_url'] = preg_replace('/\/+$/', '/', $url);
        $data['patterns'] = $this->getPatterns();

        // share
        view()->composer('MediaManager::_manager', function ($view) use ($data) {
            $view->with($data);
        });
    }

    protected function getPatterns()
    {
        $resourcePath = $this->publicPath . '/patterns';
        $pattern_path = public_path($resourcePath);

        if (!$this->app['files']->exists($pattern_path)) {
            return json_encode([]);
        }

        $patterns = collect(
            $this->app['files']->allFiles($pattern_path)
        )->map(function ($item) use ($resourcePath) {
            $name = str_replace('\\', '/', $item->getPathName());

            return preg_replace('/.*\/patterns/', '/' . $resourcePath, $name);
        });

        return json_encode($patterns);
    }
}
