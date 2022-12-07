<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| API URI
|--------------------------------------------------------------------------
|
| http://ipinfodb.com/ Offer a free IP Geolocation tools,
| The API returns the location of an IP address (country, region, city, zipcode,
| latitude, longitude) and the associated timezone in XML or JSON format.
|
*/
$config['api'] = 'http://api.ipinfodb.com/';

/*
|--------------------------------------------------------------------------
| API VERSION
|--------------------------------------------------------------------------
|
| Version of the API
|
*/
$config['api_version'] = 'v3';

/*
|--------------------------------------------------------------------------
| API KEY
|--------------------------------------------------------------------------
|
| The API KEY : You can get yours from here http://ipinfodb.com/register.php
|
*/
$config['api_key'] = '0ff483f9188e04d31b3a64fb4d68a87fbb3352bde2eaedbe81cc76a16663613c';

/*
|--------------------------------------------------------------------------
| FORMAT
|--------------------------------------------------------------------------
|
| The default format is a php array, but you can change it to XML, JSON or RAW format
|
| $config['format'] = ''; Returns a PHP array
|
| $config['format'] = 'json';
|
| $config['format'] = 'xml';
|
| $config['format'] = 'raw';
|
*/
$config['format'] = 'json';
