<?php
namespace Facturascripts\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Call implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $call = $app['controllers_factory'];

        $call->before(function (Request $request) use ($app) {
          $id_token = $app['security.token_storage']->getToken();
          $app['token'] = $app['security.jwt.encoder']->decode($id_token->credentials);

        }, Application::EARLY_EVENT);

        $call->get('/', 'Facturascripts\\Controller\\CallController::index');

        $call->post('/', 'Facturascripts\\Controller\\CallController::store');

        $call->get('/{id}', 'Facturascripts\\Controller\\CallController::show');

        $call->get('/edit/{id}', 'Facturascripts\\Controller\\CallController::edit');

        $call->put('/{id}', 'Facturascripts\\Controller\\CallController::update');

        $call->delete('/{id}', 'Facturascripts\\Controller\\CallController::destroy');

        return $call;
    }
}
