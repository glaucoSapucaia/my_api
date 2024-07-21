<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// Acessando pasta Routes
require "routes/autenticacao.php";
require "routes/produtos.php";

return function (App $app) {
    $container = $app->getContainer();

    // CORS
    $app->options('/{routes:.+}', function(Request $request, Response $response, array $args) {
        return $response;
    });

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    // Catch-all route to serve a 404 Not Found page if none of the routes match
    // NOTE: make sure this route is defined last
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
        $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
        return $handler($req, $res);
    });
};
