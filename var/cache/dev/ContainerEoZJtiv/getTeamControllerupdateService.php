<?php

namespace ContainerEoZJtiv;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTeamControllerupdateService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.iKoxby9.App\Controller\TeamController::update()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.iKoxby9.App\\Controller\\TeamController::update()'] = ($container->privates['.service_locator.iKoxby9'] ?? $container->load('get_ServiceLocator_IKoxby9Service'))->withContext('App\\Controller\\TeamController::update()', $container);
    }
}
