<?php
namespace Facturascripts\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Calendario implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $cal = $app['controllers_factory'];

        /*
        $cal->before(function (Request $request) use ($app) {
          $id_token = $app['security.token_storage']->getToken();
          $app['token'] = $app['security.jwt.encoder']->decode($id_token->credentials);
        }, Application::EARLY_EVENT);
        */
        $cal->get('/', 'Facturascripts\\Controller\\CalendarioController::index');

        $cal->post('/{pepe}', 'Facturascripts\\Controller\\CalendarioController::store');

        $cal->get('/{id}', 'Facturascripts\\Controller\\CalendarioController::show');

        $cal->get('/edit/{id}', 'Facturascripts\\Controller\\CalendarioController::edit');

        $cal->put('/{id}', 'Facturascripts\\Controller\\CalendarioController::update');

        $cal->delete('/{id}', 'Facturascripts\\Controller\\CalendarioController::destroy');

        return $cal;
    }
}
