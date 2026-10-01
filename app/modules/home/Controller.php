<?php

class HomeController {

    public function showHome(): void {
        // Carrega a view de Home
        require_once __DIR__ . '/views/Home.php';
    }

}