<?php
require __DIR__ . '/../vendor/autoload.php';

// Teste 1: Verificação de classe
echo "Teste de existência: ";
var_dump(class_exists('App\Controller\GroupController'));

// Teste 2: Instanciação real
try {
    $controller = new App\Controller\GroupController();
    echo "\nInstanciação OK!\n";
    print_r($controller->index());
} catch (Error $e) {
    echo "\nFALHA: " . $e->getMessage();
}