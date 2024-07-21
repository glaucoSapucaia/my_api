<?php

use Slim\App;

return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);

    // Recuperando container
    $dependecies = require "dependencies.php";
    $container = $dependecies($app);

    // Autenticando usuários
    $app->add(new Tuupola\Middleware\JwtAuthentication(
        [
            "header" => "Autorization",
            "regexp" => "/(.*)/",
            "path" => "/api",
            "ignore" => ["/api/token"],
            "secret" => $container->get('settings')['secretKey'],
        ]
    ));

    // CORS
    $app->add(function($req, $res, $next) {
        $response = $next($req, $res);
        return $response
                    // Definindo sites | * = todos!
                    ->withHeader('Access-Control-Allow-Origin', '*')
                    // Definindo headers
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    // Definindo métodos
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};
