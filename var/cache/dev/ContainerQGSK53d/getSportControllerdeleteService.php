<?php

namespace ContainerQGSK53d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSportControllerdeleteService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.0jGNUZz.App\Controller\SportController::delete()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.0jGNUZz.App\\Controller\\SportController::delete()'] = ($container->privates['.service_locator.0jGNUZz'] ?? $container->load('get_ServiceLocator_0jGNUZzService'))->withContext('App\\Controller\\SportController::delete()', $container);
    }
}
