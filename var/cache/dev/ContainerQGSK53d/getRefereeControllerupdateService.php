<?php

namespace ContainerQGSK53d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getRefereeControllerupdateService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.l6oBZ.1.App\Controller\RefereeController::update()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.l6oBZ.1.App\\Controller\\RefereeController::update()'] = ($container->privates['.service_locator.l6oBZ.1'] ?? $container->load('get_ServiceLocator_L6oBZ_1Service'))->withContext('App\\Controller\\RefereeController::update()', $container);
    }
}
