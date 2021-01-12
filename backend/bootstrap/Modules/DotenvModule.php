<?php
namespace Bootstrap\Modules;

use Storage\Bootstrap\Module\ModuleInterface;

use DI\Container;
use Dotenv\Dotenv;

class DotenvModule implements ModuleInterface
{
    public function run(Container $container): void
    {
        $dotenv = Dotenv::createArrayBacked(SERVER_BASE_DIR, [".env"]);
        $envVars = (array)$dotenv->load();

        if(count($envVars) > 0)
        {
            foreach($envVars as $key => $value)
            {
                $parsedKey = $this->formatKeyToDependencyContainerFormat($key);
                $container->set($parsedKey, $value);
            }
        }
    }

    private function formatKeyToDependencyContainerFormat(string $key) : string
    {
        $parsedKey = strtolower($key);

        // Convert _ to .
        if(strpos($parsedKey, '_'))
            $parsedKey = str_replace('_', '.', $parsedKey);

        return $parsedKey;
    }
}
