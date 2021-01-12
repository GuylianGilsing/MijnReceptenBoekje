<?php
namespace Storage\Bootstrap\Module;

use DI\Container;

interface ModuleInterface
{
    /**
     * Runs the module.
     * 
     * @param \DI\Container $container A valid PHP-DI dependency container.
     * @return void
     */
    public function run(Container $container) : void;
}
