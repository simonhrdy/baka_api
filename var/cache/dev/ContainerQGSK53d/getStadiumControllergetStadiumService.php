<?php

namespace ContainerQGSK53d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getStadiumControllergetStadiumService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Wd8atRm.App\Controller\StadiumController::getStadium()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Wd8atRm.App\\Controller\\StadiumController::getStadium()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'stadium' => ['privates', '.errored..service_locator.Wd8atRm.App\\Entity\\Stadium', NULL, 'Cannot autowire service ".service_locator.Wd8atRm": it needs an instance of "App\\Entity\\Stadium" but this type has been excluded in "config/services.yaml".'],
        ], [
            'stadium' => 'App\\Entity\\Stadium',
        ]))->withContext('App\\Controller\\StadiumController::getStadium()', $container);
    }
}
