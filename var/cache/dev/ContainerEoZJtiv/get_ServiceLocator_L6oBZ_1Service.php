<?php

namespace ContainerEoZJtiv;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_L6oBZ_1Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.l6oBZ.1' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.l6oBZ.1'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'referee' => ['privates', '.errored..service_locator.l6oBZ.1.App\\Entity\\Referee', NULL, 'Cannot autowire service ".service_locator.l6oBZ.1": it needs an instance of "App\\Entity\\Referee" but this type has been excluded in "config/services.yaml".'],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'referee' => 'App\\Entity\\Referee',
            'entityManager' => '?',
        ]);
    }
}
