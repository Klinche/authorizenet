<?php

namespace Omnipay\AuthorizeNetSDK;

use Omnipay\Common\AbstractGateway;

/**
 * Authorize.Net AIM Class
 */
class AIMGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Authorize.Net SDK AIM';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiLoginId'     => '',
            'transactionKey' => '',
            'testMode'       => false,
            'developerMode'  => false,
        );
    }

    public function getApiLoginId()
    {
        return $this->getParameter('apiLoginId');
    }

    public function setApiLoginId($value)
    {
        return $this->setParameter('apiLoginId', $value);
    }

    public function getTransactionKey()
    {
        return $this->getParameter('transactionKey');
    }

    public function setTransactionKey($value)
    {
        return $this->setParameter('transactionKey', $value);
    }

    public function getDeveloperMode()
    {
        return $this->getParameter('developerMode');
    }

    public function setDeveloperMode($value)
    {
        return $this->setParameter('developerMode', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AuthorizeNetSDK\Message\AIMAuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AuthorizeNetSDK\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AuthorizeNetSDK\Message\AIMPurchaseRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AuthorizeNetSDK\Message\AIMVoidRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AuthorizeNetSDK\Message\AIMRefundRequest', $parameters);
    }

    public function settledBatchListReport(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AuthorizeNetSDK\Message\AIMSettledBatchListReportRequest', $parameters);
    }
}
