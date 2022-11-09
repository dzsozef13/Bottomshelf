<?php 
include_files(array(
    "Console",
    "Route",
));

class ViewController {

//   public function renderView($route){
//     include $_SERVER['DOCUMENT_ROOT']."/src/view/" . $route->getName() . ".php";
//   }


//   public function renderView($route)
//     {
//         $layoutName = 'homeLayout';
//         // Add logic which decides which layout shoud be used for specific pages
//         // if (Application::$app->controller) {
//         //     $layoutName = Application::$app->controller->layout;
//         // }
//         $viewContent = $this->renderViewOnly($route);
//         ob_start();
//         // include_once $_SERVER['DOCUMENT_ROOT']."/src/view/layouts/".$layoutName.".php";
//         $layoutContent = ob_get_clean();
//         return str_replace('{{content}}', $viewContent, $layoutContent);
//     }

    public function render($view) {
        console_log("Rendering: " . $view);
        include_files(array(ucfirst($view)));
    }

    public function print($message) {
        echo $message;
    }

}