<?php

namespace ContainerHmKdxZI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_0jGNUZzService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.0jGNUZz' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.0jGNUZz'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'sport' => ['privates', '.errored..service_locator.0jGNUZz.App\\Entity\\Sport', NULL, 'Cannot autowire service ".service_locator.0jGNUZz": it needs an instance of "App\\Entity\\Sport" but this type has been excluded in "config/services.yaml".'],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'sport' => 'App\\Entity\\Sport',
            'entityManager' => '?',
        ]);
    }
}
