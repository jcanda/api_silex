<?php
namespace Facturascripts\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Vacio implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $vacio = $app['controllers_factory'];

        $vacio->before(function (Request $request) use ($app) {
          $id_token = $app['security.token_storage']->getToken();
          $app['token'] = $app['security.jwt.encoder']->decode($id_token->credentials);

        }, Application::EARLY_EVENT);

        $vacio->get('/', 'Facturascripts\\Controller\\VacioController::index');

        $vacio->post('/', 'Facturascripts\\Controller\\VacioController::store');

        $vacio->get('/{id}', 'Facturascripts\\Controller\\VacioController::show');

        $vacio->get('/edit/{id}', 'Facturascripts\\Controller\\VacioController::edit');

        $vacio->put('/{id}', 'Facturascripts\\Controller\\VacioController::update');

        $vacio->delete('/{id}', 'Facturascripts\\Controller\\VacioController::destroy');

        return $vacio;
    }
}
