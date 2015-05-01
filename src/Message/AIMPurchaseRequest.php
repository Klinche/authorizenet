<?php

namespace Klinche\AuthorizeNet\Message;

/**
 * Authorize.Net AIM Purchase Request
 */
class AIMPurchaseRequest extends AIMAuthorizeRequest
{
    protected $action = 'AUTH_CAPTURE';
}
