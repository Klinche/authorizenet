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
        if (!defined('AUTHORIZENET_API_LOGIN_ID')) define('AUTHORIZENET_API_LOGIN_ID', $this->getApiLoginId());
        if (!defined('AUTHORIZENET_TRANSACTION_KEY')) define('AUTHORIZENET_TRANSACTION_KEY', $this->getTransactionKey());
        if (!defined('AUTHORIZENET_SANDBOX')) define('AUTHORIZENET_SANDBOX', $this->getDeveloperMode());
        $this->atd = new \AuthorizeNetTD();
    }

    public function sendData($data)
    {
        throw new \Excetion("Implement me in your subclass");
    }

}
