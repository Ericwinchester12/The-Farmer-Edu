<!-- se encontrar exibe os dados, senao avisa que deu null -->
<?php if ($usuario): ?>
    <p>Nome: <?= htmlspecialchars($usuario->nome) ?></p>
    <p>Email: <?= htmlspecialchars($usuario->email) ?></p>
<?php else: ?>
    <p>Retorno: null</p>
<?php endif; ?>
