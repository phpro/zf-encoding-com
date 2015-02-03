<?php

namespace Phpro\EncodingCom\Service;

use Phpro\EncodingCom\Options\EncodingComOptions;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\Uri\Http as HttpUri;

/**
 * Class RouteAssembler
 *
 * @package Phpro\EncodingCom\Service
 */
class RouteAssembler
{

    /**
     * @var EncodingComOptions
     */
    protected $config;

    /**
     * @var HttpUri
     */
    protected $uri;

    /**
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * @param $router
     * @param $uri
     */
    public function __construct($config, $router, $uri)
    {
        $this->config = $config;
        $this->router = $router;
        $this->uri = $uri;
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

        $options['name'] = $route;
        $options['force_canonical'] = true;
        $options['uri'] = $this->uri;

        return $this->router->assemble($params, $options);
    }

    /**
     * @param $url
     *
     * @return string
     */
    public function buildUrl($url)
    {
        if (stripos($url, 'http://') === 0 || stripos($url, 'https://') === 0) {
            return $url;
        }

        $uri = $this->uri;
        $uri->setPath($url);

        return $uri->toString();
    }
}
