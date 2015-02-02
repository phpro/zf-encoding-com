<?php


namespace Phpro\EncodingCom\Options;


use Zend\Stdlib\AbstractOptions;

class ApiOptions extends AbstractOptions
{

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var string
     */
    protected $userKey;

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserKey()
    {
        return $this->userKey;
    }

    /**
     * @param string $userKey
     */
    public function setUserKey($userKey)
    {
        $this->userKey = $userKey;
    }
}
