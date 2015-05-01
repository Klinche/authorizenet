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

        $this->auth->trans_id = $this->getTransactionReference();

        $this->auth->card_num = $card->getNumber();
        $this->auth->exp_date = $card->getExpiryDate('my');
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->auth->credit();

        return $this->response = new AIMResponse($this, $response);
    }
}
