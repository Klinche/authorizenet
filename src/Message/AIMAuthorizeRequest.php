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

        $this->aim->customer_ip = $this->getClientIp();
        $this->aim->cust_id = $this->getCustomerId();

        if ($card = $this->getCard()) {
            $card->validate();
            $this->aim->card_num = $card->getNumber();
            $this->aim->exp_date = $card->getExpiryDate('my');
            $this->aim->card_code = $card->getCvv();
            $this->aim->method = $card->getNumber();
        } elseif ($bankAccount = $this->getBankAccount()) {
            /** @var $bankAccount \Omnipay\AuthorizeNetSDK\BankAccount */
            $bankAccount->validate();
             /** @var $bankAccount \Omnipay\AuthorizeNetSDK\BankAccount */
            $bankAccount->validate();
            $echeckType = "WEB";
            if($bankAccount->getBankAccountType() == BankAccount::ACCOUNT_TYPE_BUSINESS_CHECKING) {
                $echeckType = "CCD";
            }
            $this->aim->setECheck($bankAccount->getRoutingNumber(), $bankAccount->getAccountNumber(), $bankAccount->getBankAccountType(), $bankAccount->getBankName(), $bankAccount->getName(), $echeckType);
        }
    }

    public function sendData($data)
    {
        /** @var \AuthorizeNetAIM_Response $response */
        $response = $this->aim->authorizeOnly();

        return $this->response = new AIMResponse($this, $response);
    }
}
