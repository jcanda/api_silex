<?php

namespace Facturascripts\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;

class AuthenticateController
{
    public function home(Application $app, Request $request){
      return new JsonResponse( array('message' => 'Wellcome to API Facturascripts'), 200 );
    }

    /**
     * Authenticate a user by his email & password for FS
     * @method login
     * @param  string $email Email of the user
     * @param  string $password Clear password of the user
     * @return json|Exception
     */
    public function login(Application $app, Request $request){
      $sql = "SELECT *
        FROM tblUsuarios
        WHERE email=? and password=?
        LIMIT 1;";
      return $this->authenticate($app, $request, $sql);
    }


    public function authenticate(Application $app, Request $request, $sql)
    {
        $usr = addslashes(substr($request->get('usr'), 0, 50));
        $pwd = addslashes(substr($request->get('pwd'), 0, 50));
        $ip = $request->server->get('REMOTE_ADDR');
        $ua = $request->server->get('HTTP_USER_AGENT');

        $menr = '';

        if ($usr!='' && $pwd!='') {
          $User = $app['db']->fetchAll($sql, [$usr, $pwd]);
      		if($User){

                // Datos para el token:
                $data = ['sub' => 'CENTER'];

      					$data['idUsuario'] = $v['idUsuario'];

                $jwt = $app['security.jwt.encoder']->encode($data);

                return new JsonResponse(
                    array('token' => $jwt),
                    200
                );

      				}else{ // Clave incorrecta
      					$menr = 'usuario_incorrecto';
      				}
      		}

        return new JsonResponse( array('message' => $menr), 403 );
    }
}
