<?php

namespace ContainerS2cor9s;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserControllerforgotPasswordService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.NCLQXqZ.App\Controller\UserController::forgotPassword()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.NCLQXqZ.App\\Controller\\UserController::forgotPassword()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'mailer' => ['privates', '.errored.GX8LbYe', NULL, 'Cannot determine controller argument for "App\\Controller\\UserController::forgotPassword()": the $mailer argument is type-hinted with the non-existent class or interface: "App\\Controller\\MailerInterface". Did you forget to add a use statement?'],
        ], [
            'entityManager' => '?',
            'mailer' => '?',
        ]))->withContext('App\\Controller\\UserController::forgotPassword()', $container);
    }
}
