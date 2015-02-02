<?php

namespace Phpro\EncodingCom\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class LocalTunnelOptions
 *
 * @package Phpro\EncodingCom\Options
 */
class LocalTunnelOptions extends AbstractOptions
{

    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var string
     */
    protected $host;

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
}
