<?php

namespace I9w3b\AlertMessage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AlertMessageServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViews();

        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->publishViews();
        }

        $this->registerBladeDirectives();
    }

    /**
     * Registrar os serviços da aplicação.
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerFacade();
    }

    /**
     * Paths AlertMessage
     *
     * @var object
     */
    private function path()
    {
        $path = [];
        $path['package'] = __DIR__;
        $path['config'] = $path['package'] . '/../config/config.php';
        $path['views'] = $path['package'] . '/Resources/views';
        return (object) $path;
    }

    /**
     * Aplicar automaticamente as configurações
     *
     * @return void
     */
    private function publishConfig()
    {
        $this->publishes([
            $this->path()->config => config_path('alertmessage.php'),
        ], 'config');
    }

    /**
     * Registrar as configurações
     *
     * @return void
     */
    private function registerConfig()
    {
        $this->mergeConfigFrom($this->path()->config, 'alertmessage');
    }

    /**
     * Registrar classe principal Facade
     *
     * @return void
     */
    private function registerFacade()
    {
        $this->app->singleton('alert-message', function ($app) {
            return new AlertMessage($app['session'], $app['config']);
        });
    }

    /**
     * Carregar views do pacote
     *
     * @return void
     */
    private function loadViews()
    {
        $this->loadViewsFrom($this->path()->views, 'alertmessage');
    }

    /**
     * Publicando as visualizações do pacote
     *
     * @return void
     */
    private function publishViews()
    {
        $this->publishes([
            $this->path()->views => resource_path('views/vendor/alertmessage'),
        ], 'views');
    }

    public function registerBladeDirectives()
    {
        Blade::directive('alertmessage', function () {
            return "<?php echo app('alert-message')->bladeRender(); ?>";
        });

        Blade::directive('jquery', function ($src) {
            return "<?php echo app('alert-message')->jquery($src); ?>";
        });

        Blade::directive('toastr_css', function ($href) {
            return "<?php echo app('alert-message')->toastrCss($href); ?>";
        });

        Blade::directive('toastr_js', function ($src) {
            return "<?php echo app('alert-message')->toastrJs($src); ?>";
        });

    }

}
