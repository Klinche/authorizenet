<?php

namespace Omnipay\AuthorizeNetSDK\Message;

/**
 * Authorize.Net AIM Authorize Request
 */
class AIMAuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        parent::getData();
        $this->validate('amount');

        $this->auth->customer_ip = $this->getClientIp();
        $this->auth->cust_id = $this->getCustomerId();

        if ($card = $this->getCard()) {
            $card->validate();
            $this->auth->card_num = $card->getNumber();
            $this->auth->exp_date = $card->getExpiryDate('my');
            $this->auth->card_code = $card->getCvv();
            $this->auth->method = $card->getNumber();
        } elseif ($bankAccount = $this->getBankAccount()) {
            /** @var $bankAccount \Omnipay\AuthorizeNetSDK\BankAccount */
            $bankAccount->validate();
            $this->auth->setECheck($bankAccount->getRoutingNumber(), $bankAccount->getAccountNumber(), $bankAccount->getBankAccountType(), $bankAccount->getBankName(), $bankAccount->getName());
        }
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->auth->authorizeOnly();

        return $this->response = new AIMResponse($this, $response);
    }
}
