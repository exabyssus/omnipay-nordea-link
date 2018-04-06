<?php

namespace Omnipay\NordeaLink\Messages;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    private function getEncodedData()
    {
        $data = [
            'SOLOPMT_VERSION' => '0003', // Payment version (0002, 0003, 0004)
            'SOLOPMT_STAMP' => $this->getTransactionId(), // Payment specifier
            'SOLOPMT_RCV_ID' => $this->getMerchantId(), // Service provider's ID
            'SOLOPMT_AMOUNT' => $this->getAmount(), // Payment amount (decimal, 990.00)
            'SOLOPMT_REF' => $this->getTransactionReference(), // Payment reference
            'SOLOPMT_DATE' => date('d.m.Y'), // Payment due date
            'SOLOPMT_CUR' => $this->getCurrency(), // Currency code
            'MAC' => $this->getMerchantMac()
        ];
        return $data;
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    private function getDecodedData()
    {
        $data = [
            'SOLOPMT_RCV_ACCOUNT' => null,  // Service provider's account (optional)
            'SOLOPMT_RCV_NAME' => null, // Service provider's name (optional)
            'SOLOPMT_LANGUAGE' => $this->getLanguage(), // Payment language (3-ENG, 4-EST, 6-LAT, 7-LTU)
            'SOLOPMT_MSG' => $this->getDescription(), // Payment message
            'SOLOPMT_CONFIRM' => 'YES', // Payment confirmation (optional, YES/NO)
            'SOLOPMT_KEYVERS' => '0001', // MAC key version
            'SOLOPMT_RETURN' => $this->getReturnUrl(), // Return link
            'SOLOPMT_CANCEL' => $this->getReturnUrl(), // Cancel link
            'SOLOPMT_REJECT' => $this->getReturnUrl(), // Reject link
            'SOLOPMT_MAC' => $this->generateControlCode($this->getEncodedData()) // Payment MAC
        ];

        return $data;
    }

    /**
     * @param $data
     * @return string
     */
    private function generateControlCode($data)
    {
        $plain = implode('&', $data) . '&';
        return strtoupper(md5($plain));
    }

    /**
     * Glue together encoded and raw data
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = $this->getEncodedData() + $this->getDecodedData();
        return $data;
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|PurchaseResponse
     */
    public function sendData($data)
    {
        // Create fake response flow, so that user can be redirected
        /** @var AbstractResponse $purchaseResponseObj */
        return $purchaseResponseObj = new PurchaseResponse($this, $data);
    }

    /**
     * Generates unique payment specifier
     *
     * @return integer
     */
    protected function getPaymentSpecifier()
    {
        return date('YmdHis') . rand(10, 99);
    }
}