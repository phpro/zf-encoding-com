<?php

namespace Phpro\EncodingCom\Factory;

use Phpro\EncodingCom\Controller\NotifyController;
use Phpro\EncodingCom\Service\NotifyInterface;
use Zend\ServiceManager\Exception\RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class NotifyControllerFactory
 *
 * @package Phpro\EncodingCom\Factory
 */
class NotifyControllerFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Phpro\EncodingCom\Options\EncodingCom');
        $notifyServicekey = $config->getNotify()->getNotifyService();
        $notifyService = $serviceLocator->get($notifyServicekey);
        if (!$notifyService instanceof NotifyInterface) {
            throw new RuntimeException('The configured notify service does not implement NotifyInterface!');
        }

        return new NotifyController($config, $notifyService);
    }


} 