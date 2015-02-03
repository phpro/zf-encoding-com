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
     * @var NotifyOptions
     */
    protected $notify;

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
        $localTunnel = ($localTunnel instanceof LocalTunnelOptions) ?: new LocalTunnelOptions($localTunnel);
        $this->localTunnel = $localTunnel;
    }

    /**
     * @return NotifyOptions
     */
    public function getNotify()
    {
        return $this->notify;
    }

    /**
     * @param NotifyOptions $notify
     */
    public function setNotify($notify)
    {
        $notify = ($notify instanceof NotifyOptions) ?: new NotifyOptions($notify);
        $this->notify = $notify;
    }
}
