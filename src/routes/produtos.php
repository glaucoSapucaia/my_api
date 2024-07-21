<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/api/v1', function() {
    $this->get('/produtos', function($request, $response){

        // debug
        return $response->withJson(
            ['nome' => 'Moto G']
        );
    });
});