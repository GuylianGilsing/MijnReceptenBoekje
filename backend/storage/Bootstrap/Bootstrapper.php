<?php
namespace Storage\Bootstrap;

use DI\Container;
use Storage\Bootstrap\Module\ModuleInterface;

class Bootstrapper
{
    private array $modules = [];

    /**
     * Registers a module to bootstrap.
     * 
     * @param \Storage\Bootstrap\Module\ModuleInterface $module A class that implements the ModuleInterface.
     * @return void
     */
    public function registerModule(ModuleInterface $module) : void
    {
        $this->modules[] = $module;
    }

    /**
     * Bootstraps all registered modules.
     * 
     * @param \DI\Container $container A valid PHP-DI dependency container.
     * @return void
     */
    public function bootstrap(Container $container) : void
    {
        if(count($this->modules) > 0)
        {
            foreach($this->modules as $module)
            {
                $module->run($container);
            }
        }
    }
}
