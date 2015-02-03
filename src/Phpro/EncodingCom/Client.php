<?php

namespace Phpro\EncodingCom;

use Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;
use Gencoding\Guzzle\Encoding\EncodingClient;
use Guzzle\Service\Command\CommandInterface;
use Phpro\EncodingCom\Options\EncodingComOptions;
use Phpro\EncodingCom\Service\RouteAssembler;
use RuntimeException;

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
     * @var RouteAssembler
     */
    protected $routeAssembler;

    /**
     * @param $client
     * @param $config
     * @param $routeAssembler
     */
    public function __construct($client, $config, $routeAssembler)
    {
        $this->client = $client;
        $this->config = $config;
        $this->routeAssembler = $routeAssembler;
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
     * @param array $options
     *
     * @return EncodingResponse
     */
    public function addMedia($options)
    {
        $baseSettings = [
            'format' => $this->config->getNotify()->getFormat(),
            'notify_format' => $this->config->getNotify()->getFormat(),
            'notify' => $this->routeAssembler->buildRoute('encodingcom/notify'),
        ];

        $options = array_merge($baseSettings, $options);
        $options['source'] = $this->routeAssembler->buildUrl($options['source']);

        $command = $this->client->getCommand('AddMedia', $options);
        return $this->runCommand($command);
    }

}
