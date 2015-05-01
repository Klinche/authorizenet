<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net AIM Purchase Request
 */
class AIMPurchaseRequest extends AIMAuthorizeRequest
{
    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->auth->authorizeAndCapture();

        return $this->response = new AIMResponse($this, $response);
    }
}
