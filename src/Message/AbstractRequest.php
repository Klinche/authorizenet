<?php

namespace Omnipay\AuthorizeNetSDK\Message;

use Omnipay\AuthorizeNetSDK\BankAccount;

/**
 * Authorize.Net Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /** @var \AuthorizeNetAIM */
    protected $aim = null;


    public function getApiLoginId()
    {
        return $this->getParameter('apiLoginId');
    }

    public function setApiLoginId($value)
    {
        return $this->setParameter('apiLoginId', $value);
    }

    public function getTransactionKey()
    {
        return $this->getParameter('transactionKey');
    }

    public function setTransactionKey($value)
    {
        return $this->setParameter('transactionKey', $value);
    }

    public function getDeveloperMode()
    {
        return $this->getParameter('developerMode');
    }

    public function setDeveloperMode($value)
    {
        return $this->setParameter('developerMode', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    public function getHashSecret()
    {
        return $this->getParameter('hashSecret');
    }

    public function setHashSecret($value)
    {
        return $this->setParameter('hashSecret', $value);
    }

    public function getBankAccount()
    {
        return $this->getParameter('bankAccount');
    }

    public function setBankAccount($value)
    {
        if ($value && !$value instanceof BankAccount) {
            $value = new BankAccount($value);
        }

        return $this->setParameter('bankAccount', $value);
    }

    public function getData()
    {
        define("AUTHORIZENET_API_LOGIN_ID", $this->getApiLoginId());
        define("AUTHORIZENET_TRANSACTION_KEY", $this->getTransactionKey());
        define("AUTHORIZENET_SANDBOX", $this->getDeveloperMode());
        $this->aim = new \AuthorizeNetAIM();

        $this->aim->amount = $this->getAmount();
        $this->aim->invoice_num =  $this->getTransactionId();
        $this->aim->description = $this->getDescription();

        if ($card = $this->getCard()) {
            // customer billing details
            $this->aim->first_name = $card->getBillingFirstName();
            $this->aim->last_name = $card->getBillingLastName();
            $this->aim->company = $card->getBillingCompany();
            $this->aim->address = trim(
                $card->getBillingAddress1()." \n".
                $card->getBillingAddress2()
            );
            $this->aim->city = $card->getBillingCity();
            $this->aim->state = $card->getBillingState();
            $this->aim->zip = $card->getBillingPostcode();
            $this->aim->country = $card->getBillingCountry();
            $this->aim->phone = $card->getBillingPhone();
            $this->aim->email = $card->getEmail();

            // customer shipping details
            $this->aim->ship_to_first_name = $card->getShippingFirstName();
            $this->aim->ship_to_last_name = $card->getShippingLastName();
            $this->aim->ship_to_company = $card->getShippingCompany();
            $this->aim->ship_to_address = trim(
                $card->getShippingAddress1()." \n".
                $card->getShippingAddress2()
            );
            $this->aim->ship_to_city = $card->getShippingCity();
            $this->aim->ship_to_state = $card->getShippingState();
            $this->aim->ship_to_zip = $card->getShippingPostcode();
            $this->aim->ship_to_country = $card->getShippingCountry();
        } elseif ($bankAccount = $this->getBankAccount()) {
            // customer billing details
            $this->aim->first_name = $bankAccount->getBillingFirstName();
            $this->aim->last_name = $bankAccount->getBillingLastName();
            $this->aim->company = $bankAccount->getBillingCompany();
            $this->aim->address = trim(
                $bankAccount->getBillingAddress1()." \n".
                $bankAccount->getBillingAddress2()
            );
            $this->aim->city = $bankAccount->getBillingCity();
            $this->aim->state = $bankAccount->getBillingState();
            $this->aim->zip = $bankAccount->getBillingPostcode();
            $this->aim->country = $bankAccount->getBillingCountry();
            $this->aim->phone = $bankAccount->getBillingPhone();
            $this->aim->email = $bankAccount->getEmail();

            // customer shipping details
            $this->aim->ship_to_first_name = $bankAccount->getShippingFirstName();
            $this->aim->ship_to_last_name = $bankAccount->getShippingLastName();
            $this->aim->ship_to_company = $bankAccount->getShippingCompany();
            $this->aim->ship_to_address = trim(
                $bankAccount->getShippingAddress1()." \n".
                $bankAccount->getShippingAddress2()
            );
            $this->aim->ship_to_city = $bankAccount->getShippingCity();
            $this->aim->ship_to_state = $bankAccount->getShippingState();
            $this->aim->ship_to_zip = $bankAccount->getShippingPostcode();
            $this->aim->ship_to_country = $bankAccount->getShippingCountry();
        }
    }
}
