<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'ixudra/curl' => 
  array (
    'providers' => 
    array (
      0 => 'Ixudra\\Curl\\CurlServiceProvider',
    ),
    'aliases' => 
    array (
      'Curl' => 'Ixudra\\Curl\\Facades\\Curl',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
);