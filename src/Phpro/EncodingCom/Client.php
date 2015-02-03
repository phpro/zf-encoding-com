<?php

namespace Phpro\EncodingCom;

use Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;
use Gencoding\Guzzle\Encoding\EncodingClient;
use Guzzle\Service\Command\CommandInterface;
use Phpro\EncodingCom\Options\EncodingComOptions;
use RuntimeException;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\Uri\Http as HttpUri;

/**
 * Class Client
 *
 * @package Phpro\EncodingCom
 */
class Client
{

    /**
     * @var EncodingClient
     */
    protected $client;

    /**
     * @var EncodingComOptions
     */
    protected $config;

    /**
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * @param $client
     * @param $config
     * @param $router
     */
    public function __construct($client, $config, $router)
    {
        $this->client = $client;
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * @param CommandInterface $command
     * @return EncodingResponse
     */
    protected function runCommand($command)
    {
        try {
            return $command->getResult();
        } catch (\Exception $e) {
            throw new RuntimeException('Could not run encoding.com request.', 0, $e);
        }
    }

    /**
     * @param       $route
     * @param array $params
     * @param array $options
     *
     * @return string
     */
    protected function buildUrl($route, $params = [], $options = [])
    {
        $params['hash'] = $this->config->getHash();
        $options['force_canonical'] = true;

        // Set tunneled host:
        if ($this->config->getLocalTunnel()->isEnabled()) {
            $host = $this->config->getLocalTunnel()->getHost();
            $options['uri'] = new HttpUri('http://' . $host);
        }

        return $this->router->assemble($route, $params, $options);
    }

    /**
     * @param array $options
     *
     * @return EncodingResponse
     */
    public function addMedia($options)
    {
        $baseSettings = [
            'format' => $this->config->getNotify()->getFormat(),
            'notify_format' => $this->config->getNotify()->getFormat(),
            'notify' => $this->buildUrl('encodingcom/notify'),
        ];

        $options = array_merge($baseSettings, $options);

        $command = $this->client->getCommand('AddMedia', $options);
        return $this->runCommand($command);
    }

} 