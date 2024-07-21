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

    // Recuperando dados por ID
    // $args -> Retorna demais parametros enviados na URL - {}
    $this->get('/produtos/lista/{id}', function($request, $response, $args) {
        // debug
        // var_dump($args);

        // findOrFail() -> Faz busca de dados especificados
        $produto = Produto::findOrFail($args['id']);

        return $response->withJson($produto);
    });

    // Atualizando dados por ID
    $this->put('/produtos/atualiza/{id}', function($request, $response, $args) {
        // Recuperando dados para atualização
        $dados = $request->getParsedBody();

        // fluxo de validação de dados recebidos

        $produto = Produto::findOrFail($args['id']);

        // Atualizando dados
        $produto->update($dados);

        return $response->withJson($produto);
    });

    // Removendo dados
    $this->get('/produtos/remove/{id}', function($request, $response, $args) {
        $produto = Produto::findOrFail($args['id']);

        // fluxo para validação do DELETE
        // Além do id do produto, podemos inserir um id_cliente, para validar a remoção de produtos apenas do usuário

        // Removendo dados
        $produto->delete();

        return $response->withJson($produto);
    });
});