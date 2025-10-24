<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Inflector;

class HomeController extends AppController
{
    public function index()
    {
        $controllers = [];

        // caminho para src/Controller
        $dir = ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controller';

        foreach (glob($dir . DIRECTORY_SEPARATOR . '*Controller.php') as $file) {
            $base = basename($file, 'Controller.php'); // Ex: Employees, OrdersController -> Employees
            // ignorar controllers não de rota
            if (in_array($base, ['App', 'AppController', 'Error', 'ErrorController'])) {
                continue;
            }
            // label legível (Humanize)
            $label = Inflector::humanize(Inflector::underscore($base)); // "OrderItems" -> "Order Items"
            // url em kebab-case: menu_items -> menu-items
            $urlSegment = strtolower(Inflector::dasherize(Inflector::underscore($base)));
            $controllers[] = [
                'name' => $base,
                'label' => $label,
                'url' => '/' . $urlSegment
            ];
        }

        // ordenar alfabeticamente pelo label
        usort($controllers, function($a, $b){ return strcasecmp($a['label'], $b['label']); });

        $this->set(compact('controllers'));
        // opcional: setar title
        $this->set('title', 'Painel');
    }
}
