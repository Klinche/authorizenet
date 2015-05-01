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

        $this->auth->trans_id = $this->getTransactionReference();

        return $data;
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->auth->priorAuthCapture();

        return $this->response = new AIMResponse($this, $response);
    }
}
