<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

/**
 * @SWG\Info(title="API TamTam", version="0.1")
 */

//handling CORS preflight request
$app->before(function (Request $request) {

}, Application::EARLY_EVENT);

//handling CORS respons with right headers
$app->after(function (Request $request, Response $response) {
    //$response->headers->set('Access-Control-Allow-Origin', '*');
    //$response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
});

//accepting JSON
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->error(function (\Exception $e, $code) use ($app) {
    $app['monolog']->addError($e->getMessage());
    $app['monolog']->addError($e->getTraceAsString());

    if ($app['debug']) {
      return new JsonResponse(
          array(
              'statusCode' => $code,
              'message' => $e->getMessage(),
              'stacktrace' => $e->getTraceAsString(),
          )
      );
    } else {
      //ENVIAR MAIL!!!!!
      $message = \Swift_Message::newInstance()
          ->setSubject('[API FS] Error - '.$e->getMessage())
          ->setFrom(array('noreply@dominio.com'))
          ->setTo(array('usuario@dominioaenviar.com'))
          ->setBody($e->getMessage()." - ".$e->getTraceAsString());

      $app['mailer']->send($message);
      return new JsonResponse( array('message' => 'Error'), 500);
    }
});

return $app;
