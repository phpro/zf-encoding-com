<?php

namespace PhproTest\EncodingCom\Service;

use Phpro\EncodingCom\Options\EncodingComOptions;
use Phpro\EncodingCom\Service\RouteAssembler;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\Uri\Http;

/**
 * Class RouteAssemblerTest
 *
 * @package PhproTest\EncodingCom\Service
 */
class RouteAssemblerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var RouteAssembler
     */
    protected $routeAssembler;

    /**
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * @var Http
     */
    protected $uri;

    /**
     *  Set up dependencies
     */
    public function setUp()
    {
        $rawConfig = require __DIR__.'/../../../../config/module.config.php';
        $config = new EncodingComOptions($rawConfig['phpro_encoding_com']);

        $this->router = $this->getMock('Zend\Mvc\Router\RouteStackInterface');
        $this->uri = new Http('http://localhost');
        $this->routeAssembler = new RouteAssembler($config, $this->router, $this->uri);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_build_routes()
    {
        $expected = 'http://localhost/path/to/route';
        $this->router
            ->expects($this->any())
            ->method('assemble')
            ->with([
                    'hash' => 'hash',
                ], [
                    'name' => 'route',
                    'force_canonical' => true,
                    'uri' => $this->uri
                ])
            ->will($this->returnValue($expected));

        $this->assertEquals($this->routeAssembler->buildRoute('route'), $expected);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_build_urls()
    {
        $expected = 'http://localhost/path/to/url';
        $this->assertEquals($this->routeAssembler->buildUrl('/path/to/url'), $expected);
    }
}
