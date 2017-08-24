<?php
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SecurityJWTServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Basster\Silex\Provider\Swagger\SwaggerProvider;

$now = new DateTime('now');

$app->register(new ServiceControllerServiceProvider());

$app->register(new SecurityServiceProvider());
$app->register(new SecurityJwtServiceProvider());

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => $app['driver'],
        'host' => $app['host'],
        'port' => $app['port'],
        'dbname' => $app['dbname'],
        'user' => $app['dbuser'],
        'password' => $app['password'],
    ),
    'dbs.options' => array(
        'sqlite' => array(
          'driver'   => 'pdo_sqlite',
          'path'     => __DIR__.'/sqlite/respaldo.db',
        ),
    ),
));

$app->register(new SwaggerProvider(), [
    "swagger.servicePath" => __DIR__ . "/../src",
]);

$app->register(new SwiftmailerServiceProvider());

$app->register(new HttpCacheServiceProvider(), array('http_cache.cache_dir' => __DIR__.'/../app/cache'));

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../app/logs/'.$app['environment'].'/'.$now->format('Y-m-d').'.log',
    'monolog.level' => $app['log.level'],
    'monolog.name' => 'application',
));
