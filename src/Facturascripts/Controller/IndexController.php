<?php
namespace Facturascripts\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{

  public function index(Application $app, Request $request)
  {
    $data = Array("version"=>"1.0");
    return new JsonResponse($data,200);
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
