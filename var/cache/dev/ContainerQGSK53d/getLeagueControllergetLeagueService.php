<?php

namespace ContainerQGSK53d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLeagueControllergetLeagueService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.orDyv_R.App\Controller\LeagueController::getLeague()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.orDyv_R.App\\Controller\\LeagueController::getLeague()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'league' => ['privates', '.errored..service_locator.orDyv_R.App\\Entity\\League', NULL, 'Cannot autowire service ".service_locator.orDyv_R": it needs an instance of "App\\Entity\\League" but this type has been excluded in "config/services.yaml".'],
        ], [
            'league' => 'App\\Entity\\League',
        ]))->withContext('App\\Controller\\LeagueController::getLeague()', $container);
    }
}
