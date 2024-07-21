<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// model
use App\Models\Usuario;

// firebase
use \Firebase\JWT\JWT;

// rota de autenticação | gerando TOKEN
$app->post('/api/token', function(Request $request, Response $response) {
    // recuperando dados do usuario
    $dados = $request->getParsedBody();

    // Fluxo de validação de dados

    // recuperando dados
    // ?? -> caso o dado não exista, receberá NULL
    $email = $dados['email'] ?? null;
    $senha = $dados['senha'] ?? null;

    // where -> consulta DB
    // first() -> Retorna primeiro resultado da query
    $usuario = Usuario::where('email', $email)->first();
    $usuario_array = get_object_vars($usuario);

    // verificando dados do usuario
    if (!is_null($usuario) && (md5($senha) === $usuario->senha)) {
        // valor para gerar criptografia e descriptografar
        $secretKey = $this->get('settings')['secretKey'];

        // gerando token
        $chaveAcesso = JWT::encode($usuario_array, $secretKey, 'HS256');

        return $response->withJson(
            [
                'chave' => $chaveAcesso,
            ]
        );
    }

    return $response->withJson(
        [
            'status' => 'erro'
        ]
    );
});