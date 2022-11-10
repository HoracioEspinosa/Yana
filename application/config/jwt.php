<?php

/*
|--------------------------------------------------------------------------
| JWT Authorization Parameters
|--------------------------------------------------------------------------
|
| Authorization config for JWT requests
*/
$config['key'] = '$2y$10$KK4phg7nysB3ep47IaZ8..9QtElUrMxZ71tnQ0hzXXvqmX4sDRywm';
$config['iss'] = "https://yana.com.mx/"; // domain name
$config['aud'] = "yana.com.mx"; // domain name
$config['iat'] = time(); // current time
$config['nbf'] = $config['iat'] + 30; // not using before 30 sec
$config['exp'] = $config['iat'] + 60; // valid for 1 min after generate