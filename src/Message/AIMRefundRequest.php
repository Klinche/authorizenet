<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net Refund Request
 */
class AIMRefundRequest extends AbstractRequest
{
    public function getData()
    {
        parent::getData();

        $this->validate('amount', 'transactionReference');

        $this->aim->trans_id = $this->getTransactionReference();

        $this->aim->card_num = $card->getNumber();
        $this->aim->exp_date = $card->getExpiryDate('my');
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->aim->credit();

        return $this->response = new AIMResponse($this, $response);
    }
}
