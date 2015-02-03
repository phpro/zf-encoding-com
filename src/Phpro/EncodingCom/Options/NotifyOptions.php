<?php

namespace Phpro\EncodingCom\Options;

use Zend\ServiceManager\Exception\InvalidArgumentException;
use Zend\Stdlib\AbstractOptions;

/**
 * Class NotifyOptions
 *
 * @package Phpro\EncodingCom\Options
 */
class NotifyOptions extends AbstractOptions
{

    /**
     * @var string
     */
    protected $format;

    /**
     * @var string
     */
    protected $notifyRoute;

    /**
     * @var string
     */
    protected $notifyService;

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        if (!in_array($format, ['xml', 'json'])) {
            throw new InvalidArgumentException('The notify format should be one of xml or json. Got: ' . $format);
        }
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getNotifyRoute()
    {
        return $this->notifyRoute;
    }

    /**
     * @param string $notifyRoute
     */
    public function setNotifyRoute($notifyRoute)
    {
        $this->notifyRoute = $notifyRoute;
    }

    /**
     * @return string
     */
    public function getNotifyService()
    {
        return $this->notifyService;
    }

    /**
     * @param string $notifyService
     */
    public function setNotifyService($notifyService)
    {
        $this->notifyService = $notifyService;
    }

}
