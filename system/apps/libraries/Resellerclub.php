<?php
 if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * third_party/resellerClub is one of the leading providers of domain name
 * reseller system. However, their API is very hard to use
 * directly in applications and will be prone to bugs. This is a
 * PHP abstraction for the third_party/resellerClub API and is compatible with
 * all resellers under it.
 *
 */
// Include relevant classes
// TODO: use autoloader, yes we definitely need. This is a mess.

if (file_exists(APPPATH . '/third_party/resellerClub/rc-config.php')) {
  require_once APPPATH . '/third_party/resellerClub/rc-config.php';
}

// Exceptions
require_once APPPATH . '/third_party/resellerClub/exception/ApiConnectionException.php';
require_once APPPATH . '/third_party/resellerClub/exception/InvalidArrayException.php';
require_once APPPATH . '/third_party/resellerClub/exception/InvalidItemException.php';
require_once APPPATH . '/third_party/resellerClub/exception/InvalidParameterException.php';
require_once APPPATH . '/third_party/resellerClub/exception/InvalidUrlArrayException.php';
require_once APPPATH . '/third_party/resellerClub/exception/InvalidValidationException.php';
require_once APPPATH . '/third_party/resellerClub/exception/MissingParameterException.php';

require_once APPPATH . '/third_party/resellerClub/core/Core.php';
require_once APPPATH . '/third_party/resellerClub/validation/Validation.php';
require_once APPPATH . '/third_party/resellerClub/contact/Contact.php';
require_once APPPATH . '/third_party/resellerClub/customer/Customer.php';
require_once APPPATH . '/third_party/resellerClub/domain/Domain.php';
require_once APPPATH . '/third_party/resellerClub/billing/Billing.php';
require_once APPPATH . '/third_party/resellerClub/products/Products.php';
require_once APPPATH . '/third_party/resellerClub/reseller/Resellers.php';



class resellerClub{
    
    function checkAvailability(){
        $domain = new resellerClub\Domain;
        return call_user_func_array(array($domain, __FUNCTION__), func_get_args());
        return 'll';
    }
    
    
}