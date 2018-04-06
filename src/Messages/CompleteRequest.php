<?php

namespace Omnipay\NordeaLink\Messages;

use Omnipay\Common\Exception\InvalidRequestException;
use Symfony\Component\HttpFoundation\ParameterBag;

class CompleteRequest extends AbstractRequest
{
    /**
     * Array with required response keys, boolean shows
     * if field used for control code calculation
     *
     * @var array
     */
    protected $errorResponse = [
        'SOLOPMT_RETURN_VERSION' => true,
        'SOLOPMT_RETURN_STAMP' => true,
        'SOLOPMT_RETURN_REF' => true,
        'SOLOPMT_RETURN_MAC' => false
    ];

    /**
     * Array with required response keys, boolean shows
     * if field used for control code calculation
     *
     * @var array
     */
    protected $successResponse = [
        'SOLOPMT_RETURN_VERSION' => true,
        'SOLOPMT_RETURN_STAMP' => true,
        'SOLOPMT_RETURN_REF' => true,
        'SOLOPMT_RETURN_PAID' => true,
        'SOLOPMT_RETURN_MAC' => false
    ];

    /**
     * @return array|mixed
     */
    public function getData()
    {
        if ($this->httpRequest->getMethod() == 'POST') {
            return $this->httpRequest->request->all();
        } else {
            return $this->httpRequest->query->all();
        }
    }

    /**
     * Faking sending flow
     *
     * @param array $data
     * @return CompleteResponse
     */
    public function createResponse(array $data)
    {
        // Read data from request object
        return $purchaseResponseObj = new CompleteResponse($this, $data);
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|AbstractResponse|CompleteResponse
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        //Validate response data before we process further
        $this->validate();

        // Create fake response flow
        /** @var CompleteResponse $purchaseResponseObj */
        $response = $this->createResponse($data);
        return $response;
    }

    /**
     * @throws InvalidRequestException
     */
    public function validate()
    {
        $response = $this->getData();

        $responseFields = !empty($response['SOLOPMT_RETURN_PAID']) ? $this->successResponse : $this->errorResponse;

        //check for missing fields, will throw exc. on missing fields
        foreach ($responseFields as $fieldName => $usedInHash) {
            if (!isset($response[$fieldName])) {
                throw new InvalidRequestException("The $fieldName parameter is required");
            }
        }

        $this->validateIntegrity($responseFields);
    }

    /**
     * @param array $responseFields
     * @throws InvalidRequestException
     */
    protected function validateIntegrity(array $responseFields)
    {
        $responseData = new ParameterBag($this->getData());

        // Get keys that are required for control code generation
        $controlCodeKeys = array_filter($responseFields, function ($val){
            return $val;
        });

        // Get control code required fields with values
        $controlCodeFields = array_intersect_key($responseData->all(), $controlCodeKeys);
        $controlCodeFields[] = $this->getMerchantMac();

        $plain = implode('&', $controlCodeFields) . '&';

        if ($responseData->get('SOLOPMT_RETURN_MAC') !== strtoupper(md5($plain))) {
            throw new InvalidRequestException('Data is corrupt or has been changed by a third party');
        }
    }
}