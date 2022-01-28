<?php

declare (strict_types=1);
namespace RectorPrefix20220128;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(\Rector\CakePHP\Set\CakePHPSetList::CAKEPHP_37);
    $containerConfigurator->import(\Rector\CakePHP\Set\CakePHPLevelSetList::UP_TO_CAKEPHP_36);
};
