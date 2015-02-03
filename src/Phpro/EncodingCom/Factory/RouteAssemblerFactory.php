<?php

namespace Phpro\EncodingCom\Factory;

use Phpro\EncodingCom\Service\RouteAssembler;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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

        return new RouteAssembler($config, $router);
    }
}
