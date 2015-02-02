<?php

namespace Phpro\EncodingCom\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class EncodingComOptions
 *
 * @package Phpro\EncodingCom\Options
 */
class EncodingComOptions extends AbstractOptions
{

    /**
     * @var ApiOptions
     */
    protected $api;

    /**
     * @var LocalTunnelOptions
     */
    protected $localTunnel;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @return ApiOptions
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param ApiOptions $api
     */
    public function setApi($api)
    {
        $api = ($api instanceof ApiOptions) ?: new ApiOptions($api);
        $this->api = $api;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return LocalTunnelOptions
     */
    public function getLocalTunnel()
    {
        return $this->localTunnel;
    }

    /**
     * @param LocalTunnelOptions $localTunnel
     */
    public function setLocalTunnel($localTunnel)
    {
        $localTunnel = ($localTunnel instanceof ApiOptions) ?: new LocalTunnelOptions($localTunnel);
        $this->localTunnel = $localTunnel;
    }
}
