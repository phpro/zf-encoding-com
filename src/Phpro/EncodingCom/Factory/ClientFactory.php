<?php

namespace Phpro\EncodingCom\Factory;


use Gencoding\Guzzle\Encoding\EncodingClient;
use Phpro\EncodingCom\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ClientFactory
 *
 * @package Phpro\EncodingCom\Factory
 */
class ClientFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $router = $serviceLocator->get('HttpRouter');
        $config = $serviceLocator->get('Phpro\EncodingCom\Options\EncodingCom');
        $apiConfig = $config->getApi();
        $encodingClient = EncodingClient::factory([
            'userid' => $apiConfig->getUserId(),
            'userkey' => $apiConfig->getUserKey(),
        ]);

        return new Client($encodingClient, $config, $router);
    }
}
