<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net AIM Report Request
 */
class AIMReportRequest extends AbstractRequest
{
    /** @var \AuthorizeNetTD */
    protected $atd = null;

    public function getData()
    {
        define("AUTHORIZENET_API_LOGIN_ID", $this->getApiLoginId());
        define("AUTHORIZENET_TRANSACTION_KEY", $this->getTransactionKey());
        define("AUTHORIZENET_SANDBOX", $this->getDeveloperMode());
        $this->atd = new \AuthorizeNetTD();
    }

    public function sendData($data)
    {
        throw new \Excetion("Implement me in your subclass");
    }

}
