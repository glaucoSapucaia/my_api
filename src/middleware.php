<?php

use Slim\App;

return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);

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
