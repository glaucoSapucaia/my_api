<?php
    // Atualize as dependencias | composer.json (autoload | psr-4)
    namespace App\Models;

    // Herdando Model Eloquent
    use Illuminate\Database\Eloquent\Model;

    class Produto extends Model {
        // Definindo campos validos para recebimento de dados
        protected $fillable = [
            'titulo', 'descricao', 'preco', 'fabricante', 'created_at', 'updated_at',
        ];
    }