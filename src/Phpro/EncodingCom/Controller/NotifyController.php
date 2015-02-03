<?php

namespace Phpro\EncodingCom\Controller;

use Phpro\EncodingCom\Options\EncodingComOptions;
use Phpro\EncodingCom\Service\NotifyInterface;
use SimpleXMLElement;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Exception\RuntimeException;
use Zend\View\Model\JsonModel;

/**
 * Class NotifyController
 *
 * @package Phpro\EncodingCom\Controller
 */
class NotifyController extends AbstractActionController
{

    /**
     * @var EncodingComOptions
     */
    protected $config;

    /**
     * @var NotifyInterface
     */
    protected $notifyService;

    /**
     * @param $config
     * @param $notifyService
     */
    public function __construct($config, $notifyService)
    {
        $this->config = $config;
        $this->notifyService = $notifyService;
    }

    /**
     * Validates hash
     */
    protected function guardValidHash()
    {
        $hash = $this->params('hash');
        if (!$hash || $this->config->getHash() != $hash) {
            throw new RuntimeException(sprintf('Invalid hash: %s', $hash));
        }
    }

    /**
     * @param $format
     * @param $data
     *
     * @return \StdClass|SimpleXmlElement
     * @throws
     */
    protected function parseData($format, $data)
    {
        if (!$data) {
            throw new RuntimeException(sprintf('No %s data could be found', $format));
        }

        switch ($format) {
            case 'json':
                return Json::decode($data, Json::TYPE_OBJECT);
                break;
            case 'xml':
                return new SimpleXMLElement($data);
                break;
            default:
                throw new RuntimeException(sprintf('Invalid format type %s', $format));
                break;
        }
    }

    /**
     * @return JsonModel
     */
    public function notifyAction()
    {
        $this->guardValidHash();
        $format = $this->config->getNotify()->getFormat();
        $rawData = $this->params()->fromPost($format);
        $data = $this->parseData($format, $rawData);

        $this->notifyService->notify($data);

        return new JsonModel(['success' => true]);
    }
    
}
