<?php

namespace PhproTest\EncodingCom\Controller;

use Phpro\EncodingCom\Controller\NotifyController;
use Phpro\EncodingCom\Options\EncodingComOptions;
use Phpro\EncodingCom\Service\NotifyInterface;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * Class NotifyControllerTest
 *
 * @package PhproTest\EncodingCom\Controller
 */
class NotifyControllerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var NotifyController
     */
    protected $controller;

    /**
     * @var NotifyInterface
     */
    protected $notifyService;

    /**
     * @var Params
     */
    protected $params;

    /**
     * Add dependencies
     */
    protected function setUp()
    {
        $rawConfig = require __DIR__ . '/../../../../config/module.config.php';
        $config = new EncodingComOptions($rawConfig['phpro_encoding_com']);
        $this->notifyService = $this->getMock('Phpro\EncodingCom\Service\NotifyInterface');

        $this->params = $this->getMock('Zend\Mvc\Controller\Plugin\Params', [], [], '', false);
        $this->params->expects($this->any())->method('__invoke')->will($this->returnSelf());

        $this->controller = new NotifyController($config, $this->notifyService);
        $this->controller->getPluginManager()->setService('params', $this->params);
    }

    /**
     * @param $type
     * @param $key
     * @param $value
     */
    protected function mockParam($type, $key, $value)
    {
        $this->params
            ->expects($this->any())
            ->method('from' . ucfirst($type))
            ->with($key)
            ->will($this->returnValue($value));
    }

    /**
     * @test
     */
    public function it_should_retrieve_encoding_notification()
    {
        $xml = '<root><item>value</item></root>';
        $this->mockParam('route', 'hash', 'hash');
        $this->mockParam('post', 'xml', $xml);

        $this->notifyService
            ->expects($this->once())
            ->method('notify')
            ->with(new \SimpleXMLElement($xml));

        $result = $this->controller->notifyAction();
        $this->assertEquals($result->getVariable('success'), true);
    }

}
