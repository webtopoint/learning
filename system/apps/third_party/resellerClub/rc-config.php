<?php

/**
 * Resellerclub Configuration
 */

/** GET and POST methods **/
define('METHOD_GET', 0);
define('METHOD_POST', 1);



if ('development' === ENVIRONMENT) {
  define('RESELLER_ID', '1016138');
  define('RESELLER_API_KEY', '8ACucqbp2bYCr97g0DwEHsS7qjAIPah8');
  define('RESELLER_DOMAIN', 'test.httpapi.com');
}
elseif ('production' === ENVIRONMENT) {
  define('RESELLER_ID', '');
  define('RESELLER_API_KEY', '');
  define('RESELLER_DOMAIN', 'httpapi.com');
}
