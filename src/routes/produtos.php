<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/api/v1', function() {
    $this->get('/produtos/lista', function($request, $response){

        // ORM -> Object Relational Mapper
        // Illuminate | Eloquent ORM

        

        // debug
        // return $response->withJson(
        //     ['nome' => 'Moto G']
        // );
    });
});