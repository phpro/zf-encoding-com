<?php

namespace PhproTest\EncodingCom\Options;

use Phpro\EncodingCom\Options\EncodingComOptions;

class EncodingComOptionsTes extends \PHPUnit_Framework_TestCase
{

    /**
     * @var EncodingComOptions
     */
    protected $config;

    public function setUp()
    {
        $rawConfig = require __DIR__.'/../../../../config/module.config.php';
        $this->config = new EncodingComOptions($rawConfig['phpro_encoding_com']);
    }

    /**
     * @test
     */
    public function it_should_convert_config_to_options()
    {
        $this->assertEquals($this->config->getApi()->getUserId(), 'userid');
        $this->assertEquals($this->config->getApi()->getUserKey(), 'userkey');
        $this->assertEquals($this->config->getNotify()->getFormat(), 'xml');
        $this->assertEquals($this->config->getNotify()->getNotifyRoute(), 'encodingcom/notify');
        $this->assertEquals($this->config->getNotify()->getNotifyService(), 'custom-notify-service-key');
        $this->assertEquals($this->config->getLocalTunnel()->isEnabled(), false);
        $this->assertEquals($this->config->getLocalTunnel()->getHost(), 'subdomain.ngrok.com');
        $this->assertEquals($this->config->getHash(), 'hash');
    }
}
