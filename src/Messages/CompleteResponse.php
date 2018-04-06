<?php

namespace Omnipay\NordeaLink\Messages;

class CompleteResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (!empty($this->data['SOLOPMT_RETURN_PAID'])) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return empty($this->data['SOLOPMT_RETURN_PAID']);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if (empty($this->data['SOLOPMT_RETURN_PAID'])) {
            return 'Timeout or user canceled payment';
        }
        return 'Unknown error';
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        return $this->data['SOLOPMT_RETURN_PAID'];
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}