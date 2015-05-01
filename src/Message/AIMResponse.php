<?php

namespace Omnipay\AuthorizeNetSDK\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Authorize.Net AIM Response
 */
class AIMResponse extends AbstractResponse
{
    /** @var \AuthorizeNetAIM_Response */
    protected $response = null;

    public function __construct(RequestInterface $request, \AuthorizeNetAIM_Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function isSuccessful()
    {
        return $this->response->approved;
    }

    public function getCode()
    {
        return $this->response->response_code;
    }

    public function getReasonCode()
    {
        return $this->response->response_reason_code;
    }

    public function getMessage()
    {
        return $this->response->response_reason_text;
    }

    public function getErrorMessage()
    {
        if (isset($this->response->error_message)) {
            return $this->response->error_message;
        }

        return null;
    }

    public function getAuthorizationCode()
    {
        return $this->response->authorization_code;
    }

    public function getAVSCode()
    {
        return $this->response->avs_response;
    }

    public function getTransactionReference()
    {
        return $this->response->transaction_id;
    }
}
