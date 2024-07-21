<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// Model
use App\Models\Produto;

$app->group('/api/v1', function() {
    // listando produtos
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

    // Adicionando produtos
    $this->post('/produtos/adiciona', function($request, $response) {
        // Recuperando corpo da requisição
        $dados = $request->getParsedBody();

        // Fluxo para validação de dados antes da inserção no DB

        // Criando produto no DB
        $produto = Produto::create($dados);

        return $response->withJson($produto);
    });
});