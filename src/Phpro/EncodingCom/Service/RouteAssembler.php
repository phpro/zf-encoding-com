<?php

namespace Phpro\EncodingCom\Service;

use Phpro\EncodingCom\Options\EncodingComOptions;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\Uri\Http as HttpUri;

class RouteAssembler
{

    /**
     * @var EncodingComOptions
     */
    protected $config;

    /**
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * @param $config
     * @param $router
     */
    public function __construct($config, $router)
    {
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * @return HttpUri
     */
    protected function getUri()
    {
        if ($this->config->getLocalTunnel()->isEnabled()) {
            return new HttpUri('http://' . $this->config->getLocalTunnel()->getHost());
        }
        return new HttpUri();
    }

    /**
     * @param       $route
     * @param array $params
     * @param array $options
     *
     * @return string
     */
    public function buildRoute($route, $params = [], $options = [])
    {
        $params['hash'] = $this->config->getHash();
        $options['force_canonical'] = true;
        $options['uri'] = $this->getUri();

        return $this->router->assemble($route, $params, $options);
    }

    /**
     * @param $url
     *
     * @return string
     */
    public function buildUrl($url)
    {
        if (stripos($url, 'http://') == 0 || stripos($url, 'https://') == 0) {
            return $url;
        }

        $uri = $this->getUri();
        return $uri . '/' . ltrim($url, '/');
    }

}