<?php

namespace Omnipay\NordeaLink\Messages;

use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

abstract class AbstractResponse extends CommonAbstractResponse
{
    /**
     * @return null|string
     */
    public function getMessage()
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        $data = $this->getData();
        return $data['SOLOPMT_REF'] ?? $data['SOLOPMT_REF'];
    }
}