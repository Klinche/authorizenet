<?php

namespace Omnipay\AuthorizeNetSDK\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Authorize.Net AIM Report Response
 */
class AIMTransactionListReportResponse extends AIMReportResponse
{
    /** $response \AuthorizeNetTD_Response */
    public $response = null;


    /**
     * Returns the transactions
     *
     * @return array
     */
    public function getTransactions()
    {
        $transactions = array();

        foreach($this->response->xml->transactions->transaction as $transaction) {
            $transactions[] = $transaction;
        }

        return $transactions;
    }

}
