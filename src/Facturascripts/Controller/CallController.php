<?php
namespace Facturascripts\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CallController
{

  public function index(Application $app, Request $request)
  {
    $sql = "SELECT * FROM tblLlamadas;";
    $all = $app['dbs']['sqlite']->fetchAll($sql);
    return new JsonResponse($all,200);
  }

  public function store(Application $app, Request $request)
  {
    return new JsonResponse(Array("msg"=>"Not Found"),404);
  }

  public function show(Application $app, Request $request)
  {
    return new JsonResponse(Array("msg"=>"Not Found"),404);
  }

  public function edit(Application $app, Request $request)
  {
    return new JsonResponse(Array("msg"=>"Not Found"),404);
  }

  public function update(Application $app, Request $request)
  {
    return new JsonResponse(Array("msg"=>"Not Found"),404);
  }

  public function destroy(Application $app, Request $request)
  {
    return new JsonResponse(Array("msg"=>"Not Found"),404);
  }

}
