<?php

namespace Phpro\EncodingCom\Factory;

use Phpro\EncodingCom\Options\EncodingComOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class EncodingComOptionsFactory
 *
 * @package Phpro\EncodingCom\Options
 */
class EncodingComOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        return new EncodingComOptions($config['phpro_encoding_com']);
    }

}
