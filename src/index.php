<?php 
require_once __DIR__ . '/../vendor/autoload.php';

use App\Utils\Routes;
use App\Utils\TwigUtils;
use TheSeer\Tokenizer\Exception;

try {
    $routes = new Routes();
    // var_dump(class_exists('App\Controller\GroupController'));
    // var_dump($routes->controller);
    // Verifica e instancia o controller
    if (!class_exists($routes->controller)) {
        throw new Exception("Controller {$routes->controller} não encontrado!");
    }
    
    $controller = new $routes->controller();
    
    // Verifica se o método index existe
    if (!method_exists($controller, 'index')) {
        throw new Exception("Método index() não existe no controller {$routes->controller}!");
    }
    
    // Obtém os dados do controller
    $data = $controller->index();
    // var_dump($_SESSION);
    // var_dump($data);
    // Renderiza o template Twig
    $twig = new TwigUtils();

    echo $twig->render($routes->template, [
        'routes' => $routes,
        'data' => $data,
    ]);

} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}