<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// Model
use App\Models\Produto;

$app->group('/api/v1', function() {
    $this->get('/produtos/lista', function($request, $response){

        // ORM -> Object Relational Mapper
        // Illuminate | Eloquent ORM

        // get() -> herdado de Eloquent Model
        $produtos = Produto::get();
        

        // debug
        // return $response->withJson(
        //     ['nome' => 'Moto G']
        // );

        return $response->withJson($produtos);
    });
});