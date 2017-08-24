<?php

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/../vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Access-Token, X-Requested-With, Origin, Content-Type, Accept, Acces-Control-Request-Method");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if($method == "OPTIONS") {
  die();
}

$app = new Silex\Application();

require __DIR__.'/../app/config/config_dev.php';

require __DIR__.'/../app/config/parameters.php';

require __DIR__.'/../app/security.php';

require __DIR__.'/../app/routes.php';

require __DIR__.'/../app/providers.php';

require __DIR__.'/../src/index.php';

$app->run();
