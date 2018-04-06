<?php

namespace Omnipay\NordeaLink\Messages;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

abstract class AbstractRequest extends CommonAbstractRequest
{
    /**
     * @return mixed
     */
    public function getControlCode()
    {
        return $this->getParameter('controlCode');
    }

    /**
     * @param $value
     */
    public function setControlCode($value)
    {
        $this->setParameter('controlCode', $value);
    }

    /**
     * @return mixed
     */
    public function getEncoding()
    {
        return $this->getParameter('encoding');
    }

    /**
     * @param $value
     */
    public function setEncoding($value)
    {
        $this->setParameter('encoding', $value);
    }

    /**
     * @return mixed|string
     */
    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * @param string $value
     */
    public function setReturnUrl($value)
    {
        $this->setParameter('returnUrl', $value);
    }

    /**
     * @param string $value
     */
    public function setPublicCertificatePath($value)
    {
        $this->setParameter('publicCertificatePath', $value);
    }

    /**
     * @return mixed
     */
    public function getPublicCertificatePath()
    {
        return $this->getParameter('publicCertificatePath');
    }

    /**
     * @param string $value
     */
    public function setPrivateCertificatePath($value)
    {
        $this->setParameter('privateCertificatePath', $value);
    }

    /**
     * @return string
     */
    public function getPrivateCertificatePath()
    {
        return $this->getParameter('privateCertificatePath');
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param string $value
     */
    public function setLanguage($value)
    {
        $this->setParameter('language', $value);
    }

    /**
     * @param $value
     */
    public function setTestMode($value)
    {
        $this->setParameter('testMode', $value);
    }

    /**
     * @return mixed
     */
    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    /**
     * @param $value
     */
    public function setGatewayUrl($value)
    {
        $this->setParameter('gatewayUrl', $value);
    }

    /**
     * @return string
     */
    public function getGatewayUrl()
    {
        return $this->getParameter('gatewayUrl');
    }

    /**
     * @param string $value
     */
    public function setGatewayTestUrl($value)
    {
        $this->setParameter('gatewayTestUrl', $value);
    }

    /**
     * @return string
     */
    public function getGatewayTestUrl()
    {
        return $this->getParameter('gatewayTestUrl');
    }

    /**
     * @return mixed
     */
    public function getMerchantMac()
    {
        return $this->getParameter('merchantMac');
    }

    /**
     * @param string $value
     */
    public function setMerchantMac($value)
    {
        $this->setParameter('merchantMac', $value);
    }

    /**
     * @param $value
     */
    public function setMerchantId($value)
    {
        $this->setParameter('merchantId', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }
}