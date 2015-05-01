<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net AIM Void Request
 */
class AIMVoidRequest extends AbstractRequest
{
    protected $action = 'VOID';

    public function getData()
    {
        parent::getData();

        $this->validate('transactionReference');

        $this->aim->trans_id = $this->getTransactionReference();
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->aim->void();

        return $this->response = new AIMResponse($this, $response);
    }
}
