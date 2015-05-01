<?php

namespace Omnipay\AuthorizeNetSDK\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Authorize.Net AIM Report Response
 */
class AIMReportResponse extends AbstractResponse
{
    /** $response \AuthorizeNetXMLResponse */
    public $response = null;

    public function __construct(RequestInterface $request, \AuthorizeNetXMLResponse $data)
    {
        $this->request = $request;
        $this->response = $data;
    }

    public function isSuccessful()
    {
        return $this->response->isOk();
    }

    public function getMessageCode()
    {
        return $this->response->getMessageCode();
    }

    public function getMessageText()
    {
        return $this->response->getMessageText();
    }

    public function getRefID()
    {
        return $this->response->getRefID();
    }

    public function getResultCode()
    {
        return $this->response->getResultCode();
    }

    public function getErrorMessage()
    {
        return $this->response->getErrorMessage();
    }

    public function xpath($path)
    {
        return $this->response->xpath($path);
    }

    public function getXML()
    {
        return $this->response->xml;
    }
}
