<?php

namespace ContainerHmKdxZI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGameControllerupdateService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.yh.BtHh.App\Controller\GameController::update()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.yh.BtHh.App\\Controller\\GameController::update()'] = ($container->privates['.service_locator.yh.BtHh'] ?? $container->load('get_ServiceLocator_Yh_BtHhService'))->withContext('App\\Controller\\GameController::update()', $container);
    }
}
