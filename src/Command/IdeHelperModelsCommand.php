<?php

namespace Kriss\WebmanEloquentIdeHelper\Command;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\FileViewFinder;
use Kriss\WebmanEloquentIdeHelper\Wrapper\LaravelContainerWrapper;
use Illuminate\View\Factory as ViewFactory;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'ide-helper:models', description: 'Generate autocompletion for models')]
class IdeHelperModelsCommand extends ModelsCommand
{
    public function __construct()
    {
        $filesystem = new Filesystem();

        $config = $this->loadConfig();

        $viewFactory = $this->createViewFactory($filesystem);

        parent::__construct($filesystem, $config, $viewFactory);

        $container = new Container();

        $container = new LaravelContainerWrapper($container);

        $container->instance('config', $config);

        $this->setLaravel($container);
    }

    private function loadConfig(): Repository
    {
        return new Repository([
            'ide-helper' => array_merge(
                require base_path('vendor/barryvdh/laravel-ide-helper/config/ide-helper.php'),
                config('plugin.kriss.webman-eloquent-ide-helper.ide-helper', []),
            ),
        ]);
    }

    private function createViewFactory(Filesystem $filesystem): ViewFactory
    {
        $resolver = new EngineResolver();

        $finder = new FileViewFinder($filesystem, []);

        // 新增事件调度器
        $events = new Dispatcher(new Container());

        return new ViewFactory($resolver, $finder, $events);
    }
}
