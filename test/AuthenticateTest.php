<?php
require __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use PHPUnit\Framework\TestCase;

class AuthenticateTest extends TestCase
{
   protected $client;

   protected function setUp()
   {
       $this->client = new GuzzleHttp\Client();
   }

    public function createApplication()
    {
        $app = new Application();
        $app['session.test'] = true;
        require __DIR__ . '/../web/app_dev.php';
        return $this->app = $app;
    }

    public function testAuthenticateCheckStatusCode() {
        $response = $this->client->request('POST', 'http://localhost:8888/login', [
          'form_params' => [
            'usr' => 'xxxx',
            'pwd' => 'xxxx',
          ]
        ]);
        $this->assertEquals(200,$response->getStatusCode());
    }
}
