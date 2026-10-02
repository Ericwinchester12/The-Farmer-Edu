<?php

require_once __DIR__ . '/../../core/router.php';
require_once __DIR__ . '/Controller.php';

// rota para acessar os testes no navegador
Router::get('/atividade-09/teste', [ControllerAtividade09::class, 'teste']);
