<?php

namespace ContainerQGSK53d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_67Lrj0GService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.67Lrj0G' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.67Lrj0G'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'playerHistory' => ['privates', '.errored..service_locator.67Lrj0G.App\\Entity\\PlayerHistory', NULL, 'Cannot autowire service ".service_locator.67Lrj0G": it needs an instance of "App\\Entity\\PlayerHistory" but this type has been excluded in "config/services.yaml".'],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'playerHistory' => 'App\\Entity\\PlayerHistory',
            'entityManager' => '?',
        ]);
    }
}
