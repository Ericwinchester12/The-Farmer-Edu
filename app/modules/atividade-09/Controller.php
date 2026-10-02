<?php

require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/../../core/database.php';

class UsuarioController {
    
    // rodando todos os testes de uma vez so
    public function showNovoUsuario() {
        $pdo = iniciarPDO();
        
        echo "<h2>Testes da Atividade 10</h2>";

        // criando um usuario de teste
        $novo = new Usuario();
        $novo->nome = 'Flavin do Pneu';
        $novo->email = 'Irineu_' . rand(6,7) . '@vocenãosabenemeu';
        $novo->senha_hash = password_hash('123', PASSWORD_DEFAULT);
        $novo->tipo_usuario = 'aluno';
        
        $novo->salvar($pdo);
        $idGerado = $novo->id;
        
        echo "<h3>Passo 1: Salvando o usuario e mostrando o ID gerado</h3>";
        require __DIR__ . '/views/novoUsuario.php';

        // testando a busca com o mesmo email
        $usuario = Usuario::buscarPorEmail($pdo, $novo->email);
        
        echo "<h3>Passo 2: Buscando o usuario pelo email e exibindo na tela</h3>";
        require __DIR__ . '/views/buscarUsuario.php';

        // testando o comportamento com sql injection
        $usuario = Usuario::buscarPorEmail($pdo, "' OR '1'='1");
        
        echo "<h3>Passo 3: Teste de SQL Injection</h3>";
        require __DIR__ . '/views/buscarUsuario.php';
        
        // limpando os dados no final
        $novo->excluir($pdo);
    }

    // so reaproveitando o metodo de cima pra funcionar na rota
    public function showBuscarUsuario() {
        $this->showNovoUsuario();
    }
}
