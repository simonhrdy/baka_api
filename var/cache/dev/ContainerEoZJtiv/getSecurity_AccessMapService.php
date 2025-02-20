<?php

namespace ContainerEoZJtiv;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSecurity_AccessMapService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'security.access_map' shared service.
     *
     * @return \Symfony\Component\Security\Http\AccessMap
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/AccessMapInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/AccessMap.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/RequestMatcherInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/ChainRequestMatcher.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/RequestMatcher/PathRequestMatcher.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/RequestMatcher/MethodRequestMatcher.php';

        $container->privates['security.access_map'] = $instance = new \Symfony\Component\Security\Http\AccessMap();

        $a = new \Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher(['POST', 'PUT', 'DELETE']);

        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([($container->privates['.security.request_matcher..tvo6Vp'] ??= new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/login'))]), ['PUBLIC_ACCESS'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/docs')]), ['PUBLIC_ACCESS'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/users/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/players/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/teams/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/countries/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/stadiums/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/sports/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/seasons/')]), ['IS_AUTHENTICATED_FULLY'], NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\ChainRequestMatcher([$a, new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/referees/')]), ['IS_AUTHENTICATED_FULLY'], NULL);

        return $instance;
    }
}
