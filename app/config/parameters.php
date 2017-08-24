<?php
// PARAMETERS
$app['driver'] = 'pdo_mysql';
$app['dbname'] = 'nombre_db';
$app['dbuser'] = 'niombre_user';
$app['password'] = 'kakitadelabuena';

// Para conexion en desarrollo.
if(php_sapi_name()=='cli-server'){
  $app['host'] = '127.0.0.1';
  $app['port'] = '3307';
}else{
  $app['host'] = 'mysql.amazonaws.com';
  $app['port'] = '3306';
}

$app['swiftmailer.local'] = array(
     'host' => 'localhost',
     'port' => '25',
     'username' => '',
     'password' => '',
     'encryption' => null,
     'auth_mode' => null
 );

$app['salto'] = 'R2d2';

// SECURITY
$app['serverName'] = "dominio.com";
// Key for signing the JWT's, I suggest generate it with base64_encode(openssl_random_pseudo_bytes(64))
//$app['secret'] =  base64_encode("secret");
$app['algorithm'] = ["HS256"];

$app['secret'] = 'bGljb3IgY2FmZSBjb24gc2lsYWdhbWVzIGVzIGxhIGNsYXZlIHNlY3JldGEgbXV5IGNodWxhIHBhcmEgcXVlIG5vIGxhIGRlY29kaWZpcXVlbg==';

$app['security.jwt'] = [
    'secret_key' => $app['secret'],
    'life_time'  => 2629750,
    //'life_time'  => 315569000, //token para 10 años.
    //'life_time'  => 60,
    'algorithm'  => ['HS256'],
    'options'    => [
        'username_claim' => 'sub', // default name, option specifying claim containing username
        'header_name'  => 'X-Access-Token',
        'token_prefix' => 'Bearer',
    ]
];

$app["swagger.cache"] = [
    "max_age" => "432000", // 5 days in seconds
    "s_maxage" => "432000", // 5 days in seconds
    "public" => true,
];

$app['users'] = function () use ($app) {
    $users = [
        'ADMIN' => array(
            'roles' => array('ROLE_ADMIN', 'ROLE_SUPER_ADMIN', 'ROLE_CENTER', 'ROLE_CLIENT'),
            // raw password is foo
            //'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
            'enabled' => true
        ),
        'CENTER' => array(
            'roles' => array('ROLE_CENTER', 'ROLE_CLIENT'),
            // raw password is foo
            //'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
            'enabled' => true
        ),
        'CLIENT' => array(
            'roles' => array('ROLE_CLIENT'),
            // raw password is foo
            //'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
            'enabled' => true
        ),
    ];
    return new Symfony\Component\Security\Core\User\InMemoryUserProvider($users);
};
