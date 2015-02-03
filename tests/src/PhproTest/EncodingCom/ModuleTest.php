<?php

namespace PhproTest\EncodingCom;
use Phpro\EncodingCom\Module;

/**
 * Class ModuleTest
 *
 * @package PhproTest\EncodingCom
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_be_initializable()
    {
        $module = new Module();
        $this->assertInstanceOf('Phpro\EncodingCom\Module', $module);
    }
    /**
     * @test
     */
    public function it_should_provide_autoloader_configuration()
    {
        $module = new Module();
        $this->assertInstanceOf('Zend\ModuleManager\Feature\AutoloaderProviderInterface', $module);
        $this->assertInternalType('array', $module->getAutoloaderConfig());
    }

    /**
     * @test
     */
    public function it_should_provide_configuration()
    {
        $module = new Module();
        $this->assertInstanceOf('Zend\ModuleManager\Feature\ConfigProviderInterface', $module);
        $this->assertInternalType('array', $module->getConfig());
    }
}
