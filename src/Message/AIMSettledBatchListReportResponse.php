<?php

namespace Omnipay\AuthorizeNetSDK\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Authorize.Net AIM Report Response
 */
class AIMSettledBatchListReportResponse extends AIMReportResponse
{
    /** $response \AuthorizeNetTD_Response */
    public $response = null;


    /**
     * Returns a list of batch ids
     *
     * @return array
     */
    public function getBatchIds()
    {
        $ids = array();
        $list = $this->response->xml->batchList;
        foreach($list as $batch) {
            $ids[] = $batch->batchId;
        }

        return $ids;
    }

    /**
     * Returns the batches
     *
     * @return array
     */
    public function getBatches()
    {
        return $this->response->xml->batchList;
    }

}
