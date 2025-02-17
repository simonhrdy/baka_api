<?php

namespace ContainerDiUfwBf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_Doctrine_Orm_State_RemoveProcessorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.doctrine.orm.state.remove_processor' shared service.
     *
     * @return \ApiPlatform\Doctrine\Common\State\RemoveProcessor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/state/ProcessorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/doctrine-common/State/RemoveProcessor.php';

        return $container->privates['api_platform.doctrine.orm.state.remove_processor'] = new \ApiPlatform\Doctrine\Common\State\RemoveProcessor(($container->services['doctrine'] ?? self::getDoctrineService($container)));
    }
}
