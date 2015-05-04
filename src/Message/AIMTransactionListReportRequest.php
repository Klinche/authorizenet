<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net TD Report Request
 */
class AIMTransactionListReportRequest extends AIMReportRequest
{

    public function sendData($data)
    {
        $batchId = $this->getBatchId();

        /** @var \AuthorizeNetTD_Response $response */
        $response = $this->atd->getTransactionList(intval($batchId));

        return $this->response = new AIMTransactionListReportResponse($this, $response);
    }

    public function getBatchId()
    {
        return $this->getParameter('batchId');
    }

    public function setBatchId($value)
    {
        return $this->setParameter('batchId', $value);
    }

}
