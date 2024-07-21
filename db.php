<?php
    // PHP_SAPI -> indica o tipo de interface que rodará o programa
    // cli -> linha de comando
    if (PHP_SAPI != 'cli') {
        // Caso a interface não seja linha de comando, finalizaremo a aplicação
        exit('Use via CLI');
    }

    require __DIR__ . '/vendor/autoload.php';

    // Instantiate the app
    $settings = require __DIR__ . '/src/settings.php';
    $app = new \Slim\App($settings);

    // Set up dependencies
    $dependencies = require __DIR__ . '/src/dependencies.php';
    // Recuperando container
    $container = $dependencies($app);

    // Criando tabelas do db
    $db = $container->get('db');

    $schema = $db->schema();
    $tabela = 'produtos';

    $schema->dropIfExists($tabela);

    $schema->create($tabela, function($table) {
        $table->increments('id');
        $table->string('titulo', 100);
        $table->text('descricao');
        $table->decimal('preco', 11, 2);
        $table->string('fabricante', 60);
        $table->date('dt_criacao');
    });

    // Alimentando tabela
    $db->table($tabela)->insert(
        [
            'titulo' => 'Smartphone Motorola Moto G6 32GB Dual Chip',
            'descricao' => 'Android Oreo - 8.0 Tela 5.7" Octa-Core 1.8 Ghz 4G Câmera 12 + 5MP (Dual Trazeira - Índigo',
            'preco' => 899.00,
            'fabricante' => 'Motorola',
            'dt_criacao' => '2019-10-22'
        ]
    );

    $db->table($tabela)->insert(
        [
            'titulo' => 'iPhone X Cinza Espacial 64GB',
            'descricao' => 'Tela 5.8 IOS 12 4G Wi-Fi Câmera 12MP - Apple',
            'preco' => 4999.00,
            'fabricante' => 'Apple',
            'dt_criacao' => '2020-01-10'
        ]
    );

?>