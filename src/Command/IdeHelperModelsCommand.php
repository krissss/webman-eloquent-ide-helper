<?php

namespace Kriss\WebmanEloquentIdeHelper\Command;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Composer\ClassMapGenerator\ClassMapGenerator;
use Illuminate\Console\Concerns\ConfiguresPrompts;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Kriss\WebmanEloquentIdeHelper\Wrapper\LaravelContainerWrapper;

function base_path($path = '')
{
    $basePath = dirname(__DIR__, 5);
    return $basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

class IdeHelperModelsCommand extends ModelsCommand
{
    protected static $defaultName = 'ide-helper:models';
    protected static $defaultDescription = 'ide-helper models';

    public function __construct()
    {
        parent::__construct(new Filesystem());

        $laravel = new Container();
        if (trait_exists(ConfiguresPrompts::class)) {
            // 为了解决 ConfiguresPrompts 中通过 $this->laravel->runningUnitTests() 的问题
            // https://github.com/krissss/webman-eloquent-ide-helper/issues/2
            $laravel = new LaravelContainerWrapper($laravel);
        }
        $laravel->instance('config', $this->loadConfig());
        $this->setLaravel($laravel);
    }

    private function loadConfig()
    {
        $items = config('plugin.kriss.webman-eloquent-ide-helper.ide-helper');
        return new Repository([
            'ide-helper' => $items,
        ]);
    }

    /**
     * 代码同父方法，重写是为了覆盖 base_path 函数
     * @inheritDoc
     */
    protected function loadModels()
    {
        $models = [];
        foreach ($this->dirs as $dir) {
            if (is_dir(base_path($dir))) {
                $dir = base_path($dir);
            }

            $dirs = glob($dir, GLOB_ONLYDIR);
            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    $this->error("Cannot locate directory '{$dir}'");
                    continue;
                }

                if (file_exists($dir)) {
                    $classMap = ClassMapGenerator::createMap($dir);

                    // Sort list so it's stable across different environments
                    ksort($classMap);

                    foreach ($classMap as $model => $path) {
                        $models[] = $model;
                    }
                }
            }
        }
        return $models;
    }
}
