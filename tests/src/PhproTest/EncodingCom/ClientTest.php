<?php

namespace PhproTest\EncodingCom;
use Gencoding\Guzzle\Encoding\EncodingClient;
use Phpro\EncodingCom\Client;
use Phpro\EncodingCom\Options\EncodingComOptions;
use Phpro\EncodingCom\Service\RouteAssembler;

/**
 * Class ClientTest
 *
 * @package PhproTest\EncodingCom
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var EncodingClient
     */
    protected $encodingClient;

    /**
     * @var RouteAssembler
     */
    protected $routeAssembler;

    /**
     * Set up test
     */
    public function setUp()
    {
        $this->encodingClient = $this->getMock('Gencoding\Guzzle\Encoding\EncodingClient', [], [], '', false);
        $this->routeAssembler = $this->getMock('Phpro\EncodingCom\Service\RouteAssembler', [], [], '', false);

        $rawConfig = require __DIR__ . '/../../../config/module.config.php';
        $config = new EncodingComOptions($rawConfig['phpro_encoding_com']);

        $this->client = new Client($this->encodingClient, $config, $this->routeAssembler);
    }

    /**
     * @param $route
     * @param $fullUrl
     */
    protected function mockRoute($route, $fullUrl)
    {
        $this->routeAssembler
            ->expects($this->any())
            ->method('buildRoute')
            ->with($route)
            ->will($this->returnValue($fullUrl));
    }

    /**
     * @param $url
     * @param $fullUrl
     */
    protected function mockUrl($url, $fullUrl)
    {
        $this->routeAssembler
            ->expects($this->any())
            ->method('buildUrl')
            ->with($url)
            ->will($this->returnValue($fullUrl));
    }

    /**
     * @param $type
     * @param $options
     */
    protected function mockCommand($type, $options)
    {
        $command = $this->getMock('Guzzle\Service\Command\CommandInterface');
        $command
            ->expects($this->any())
            ->method('getResult')
            ->will($this->returnValue(['result' => true]));

        $this->encodingClient
            ->expects($this->any())
            ->method('getCommand')
            ->with('AddMedia', $options)
            ->will($this->returnValue($command));
    }

    /**
     * @test
     */
    public function it_should_be_able_to_add_media()
    {
        $options = [
            'source' => '/file/video.mp4',
            'format' => [
                'output' => 'thumbnail',
                'time' => '20%',
            ],
        ];

        $this->mockRoute('encodingcom/notify', 'http://localhost/encodingcom/notify/hash');
        $this->mockUrl('/file/video.mp4', 'http://localhost/file/video.mp4');
        $this->mockCommand('AddMedia', [
            'source' => 'http://localhost/file/video.mp4',
            'format' => [
                'output' => 'thumbnail',
                'time' => '20%',
            ],
            'notify_format' => 'xml',
            'notify' => 'http://localhost/encodingcom/notify/hash'
        ]);

        $result = $this->client->addMedia($options);
        $this->assertEquals(['result' => true], $result);
    }

}
