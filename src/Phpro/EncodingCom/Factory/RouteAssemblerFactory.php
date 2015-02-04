<?php

namespace Phpro\EncodingCom\Factory;

use Phpro\EncodingCom\Options\LocalTunnelOptions;
use Phpro\EncodingCom\Service\RouteAssembler;
use Zend\Http\PhpEnvironment\Request as HttpRequest;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Uri\Http as HttpUri;

/**
 * Class RouteAssemblerFactory
 *
 * @package Phpro\EncodingCom\Factory
 */
class RouteAssemblerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Phpro\EncodingCom\Options\EncodingCom');
        $router = $serviceLocator->get('HttpRouter');
        $uri = $this->parseUri($serviceLocator, $config->getLocalTunnel());

        return new RouteAssembler($config, $router, $uri);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param LocalTunnelOptions      $localTunnelConfig
     *
     * @return HttpUri
     */
    protected function parseUri($serviceLocator, $localTunnelConfig)
    {
        $endpoint = null;
        $request = $serviceLocator->get('Request');

        if ($request instanceof HttpRequest) {
            $uri = $request->getUri();
            $endpoint = $uri->getScheme().'://'.$uri->getHost();
        }

        if ($localTunnelConfig->isEnabled()) {
            $endpoint = 'http://'.$localTunnelConfig->getHost();
        }

        return new HttpUri($endpoint);
    }
}
