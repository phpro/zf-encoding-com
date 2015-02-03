<?php

namespace Phpro\EncodingCom\Service;

/**
 * Interface NotifyInterface
 */
interface NotifyInterface
{

    /**
     * @param \stdClass|\SimpleXMlElement $data
     *
     * @return mixed
     */
    public function notify($data);
}
