<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net TD Report Request
 */
class AIMSettledBatchListReportRequest extends AIMReportRequest
{

    public function sendData($data)
    {
        $firstSettlementDate = $this->getFirstSettlementDate();
        $lastSettlementDate = $this->getLastSettlementDate();

        if($firstSettlementDate instanceof \DateTime) {
            $firstSettlementDate->setTimezone(new \DateTimeZone('UTC'));
            $firstSettlementDate = $firstSettlementDate->format('Y-m-d\Th:m:s');
        }

        if(!is_null($firstSettlementDate)) {
            if ($lastSettlementDate instanceof \DateTime) {
                $lastSettlementDate->setTimezone(new \DateTimeZone('UTC'));
                $lastSettlementDate = $lastSettlementDate->format('Y-m-d\Th:m:s');
            }
        } else {
            $lastSettlementDate = null;
        }

        /** @var \AuthorizeNetTD_Response $response */
        $response = $this->atd->getSettledBatchList($this->getIncludeStatistics(), $firstSettlementDate, $lastSettlementDate, true);

        return $this->response = new AIMSettledBatchListReportResponse($this, $response);
    }

    public function getFirstSettlementDate()
    {
        return $this->getParameter('firstSettlementDate');
    }

    public function setFirstSettlementDate($value)
    {
        return $this->setParameter('firstSettlementDate', $value);
    }

    public function getLastSettlementDate()
    {
        return $this->getParameter('lastSettlementDate');
    }

    public function setLastSettlementDate($value)
    {
        return $this->setParameter('lastSettlementDate', $value);
    }

    public function getIncludeStatistics()
    {
        return $this->getParameter('includeStatistics');
    }

    public function setIncludeStatistics($value)
    {
        return $this->setParameter('includeStatistics', $value);
    }

}
