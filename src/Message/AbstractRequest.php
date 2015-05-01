<?php

namespace Omnipay\AuthorizeNetSDK\Message;

use Omnipay\AuthorizeNetSDK\BankAccount;

/**
 * Authorize.Net Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /** @var \AuthorizeNetAIM */
    protected $auth = null;


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
        $this->auth = new \AuthorizeNetAIM();

        $this->auth->amount = $this->getAmount();
        $this->auth->invoice_num =  $this->getTransactionId();
        $this->auth->description = $this->getDescription();

        if ($card = $this->getCard()) {
            // customer billing details
            $this->auth->first_name = $card->getBillingFirstName();
            $this->auth->last_name = $card->getBillingLastName();
            $this->auth->company = $card->getBillingCompany();
            $this->auth->address = trim(
                $card->getBillingAddress1()." \n".
                $card->getBillingAddress2()
            );
            $this->auth->city = $card->getBillingCity();
            $this->auth->state = $card->getBillingState();
            $this->auth->zip = $card->getBillingPostcode();
            $this->auth->country = $card->getBillingCountry();
            $this->auth->phone = $card->getBillingPhone();
            $this->auth->email = $card->getEmail();

            // customer shipping details
            $this->auth->ship_to_first_name = $card->getShippingFirstName();
            $this->auth->ship_to_last_name = $card->getShippingLastName();
            $this->auth->ship_to_company = $card->getShippingCompany();
            $this->auth->ship_to_address = trim(
                $card->getShippingAddress1()." \n".
                $card->getShippingAddress2()
            );
            $this->auth->ship_to_city = $card->getShippingCity();
            $this->auth->ship_to_state = $card->getShippingState();
            $this->auth->ship_to_zip = $card->getShippingPostcode();
            $this->auth->ship_to_country = $card->getShippingCountry();
        } elseif ($bankAccount = $this->getBankAccount()) {
            // customer billing details
            $this->auth->first_name = $bankAccount->getBillingFirstName();
            $this->auth->last_name = $bankAccount->getBillingLastName();
            $this->auth->company = $bankAccount->getBillingCompany();
            $this->auth->address = trim(
                $bankAccount->getBillingAddress1()." \n".
                $bankAccount->getBillingAddress2()
            );
            $this->auth->city = $bankAccount->getBillingCity();
            $this->auth->state = $bankAccount->getBillingState();
            $this->auth->zip = $bankAccount->getBillingPostcode();
            $this->auth->country = $bankAccount->getBillingCountry();
            $this->auth->phone = $bankAccount->getBillingPhone();
            $this->auth->email = $bankAccount->getEmail();

            // customer shipping details
            $this->auth->ship_to_first_name = $bankAccount->getShippingFirstName();
            $this->auth->ship_to_last_name = $bankAccount->getShippingLastName();
            $this->auth->ship_to_company = $bankAccount->getShippingCompany();
            $this->auth->ship_to_address = trim(
                $bankAccount->getShippingAddress1()." \n".
                $bankAccount->getShippingAddress2()
            );
            $this->auth->ship_to_city = $bankAccount->getShippingCity();
            $this->auth->ship_to_state = $bankAccount->getShippingState();
            $this->auth->ship_to_zip = $bankAccount->getShippingPostcode();
            $this->auth->ship_to_country = $bankAccount->getShippingCountry();
        }
    }
}
