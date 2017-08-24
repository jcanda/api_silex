<?php
// ENTRADA POR DEFECTO:
$app->get($app['api'].'/', 'Facturascripts\\Controller\\IndexController::index');

// RUTAS SIN AUTENTICACIÓN:
$app->post($app['api'].'/login', "\Facturascripts\Controller\AuthenticateController::loginBasic");
$app->match($app['api'].'/robots.txt', "\Facturascripts\Controller\RobotsController::index");

// CONTROLLER DE EJEMPLO:
//$app->mount($app['api'].'/vacio', new \Facturascripts\Controller\Provider\Vacio());
$app->mount($app['api'].'/call', new \Facturascripts\Controller\Provider\Call());

$app->mount($app['api'].'/calendario', new \Facturascripts\Controller\Provider\Calendario());
