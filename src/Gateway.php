<?php

namespace Omnipay\NordeaLink;

use Omnipay\Common\AbstractGateway;
use Omnipay\NordeaLink\Messages\PurchaseRequest;
use Omnipay\NordeaLink\Messages\CompleteRequest;

/**
 * Class Gateway
 *
 * @package Omnipay\NordeaLink
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Nordea Link';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'gatewayUrl' => 'https://netbank.nordea.com/pnbepay/epay.jsp',
            'gatewayTestUrl' => 'https://netbank.nordea.com/pnbepaytest/epay.jsp',
            'merchantId' => '',
            'merchantMac' => '',
            'returnUrl' => '',
            'testMode' => false,
            'language' => 6,
            'encoding' => 'ISO-8859-1'
        ];
    }

    /**
     * Create transaction
     *
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Complete transaction
     *
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $options = [])
    {
        return $this->createRequest(CompleteRequest::class, $options);
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
     * @param $value
     */
    public function setMerchantId($value)
    {
        $this->setParameter('merchantId', $value);
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param $value
     */
    public function setMerchantMac($value)
    {
        $this->setParameter('merchantMac', $value);
    }

    /**
     * @return string
     */
    public function getMerchantMac()
    {
        return $this->getParameter('merchantMac');
    }

    /**
     * @param $value
     */
    public function setReturnUrl($value)
    {
        $this->setParameter('returnUrl', $value);
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param $value
     */
    public function setLanguage($value)
    {
        $this->setParameter('language', $value);
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


}