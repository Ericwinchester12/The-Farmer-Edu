<?php

class Usuario {
    public $id_usuario;
    public $nome;
    public $email;
    public $senha_hash;
    public $tipo_usuario;

    // salva os dados no banco
    public function salvar(PDO $pdo) {
        $sql = "INSERT INTO usuarios (nome, email, senha_hash, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->nome, $this->email, $this->senha_hash, $this->tipo_usuario]);
        
        // pega o id que foi gerado
        $this->id_usuario = $pdo->lastInsertId();
    }

    // busca as informacoes pelo email
    public static function buscarPorEmail(PDO $pdo, $email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($dados) {
            $user = new Usuario();
            $user->id_usuario = $dados['id_usuario'];
            $user->nome = $dados['nome'];
            $user->email = $dados['email'];
            $user->senha_hash = $dados['senha_hash'];
            $user->tipo_usuario = $dados['tipo_usuario'];
            return $user;
        }
        
        return null;
    }

    // metodo bonus: deleta o usuario pra manter limpo
    public function excluir(PDO $pdo): void {
        if ($this->id_usuario) {
            $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->id_usuario]);
        }
    }
}
