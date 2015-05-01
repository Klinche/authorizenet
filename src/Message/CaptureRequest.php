<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net Capture Request
 */
class CaptureRequest extends AbstractRequest
{

    public function getData()
    {
        parent::getData();

        $this->validate('amount', 'transactionReference');

        $this->validate('transactionReference');

        $this->aim->trans_id = $this->getTransactionReference();

        return $data;
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->aim->priorAuthCapture();

        return $this->response = new AIMResponse($this, $response);
    }
}
