<?php

namespace ContainerEoZJtiv;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPlayerControllerupdateService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.MSzna8D.App\Controller\PlayerController::update()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.MSzna8D.App\\Controller\\PlayerController::update()'] = ($container->privates['.service_locator.MSzna8D'] ?? $container->load('get_ServiceLocator_MSzna8DService'))->withContext('App\\Controller\\PlayerController::update()', $container);
    }
}
