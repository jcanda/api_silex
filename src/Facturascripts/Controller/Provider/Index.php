<?php
namespace Facturascripts\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Index implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $index = $app['controllers_factory'];

        $index->before(function (Request $request) use ($app) {
          $id_token = $app['security.token_storage']->getToken();
          $app['token'] = $app['security.jwt.encoder']->decode($id_token->credentials);

        }, Application::EARLY_EVENT);

        $index->get('/', 'Facturascripts\\Controller\\IndexController::index');

        $index->post('/', 'Facturascripts\\Controller\\IndexController::store');

        $index->get('/{id}', 'Facturascripts\\Controller\\IndexController::show');

        $index->get('/edit/{id}', 'Facturascripts\\Controller\\IndexController::edit');

        $index->put('/{id}', 'Facturascripts\\Controller\\IndexController::update');

        $index->delete('/{id}', 'Facturascripts\\Controller\\IndexController::destroy');

        return $index;
    }
}
