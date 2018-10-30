<?php

class component
{
    static public function includeComponent($nameComponent)
    {
        $pathComponent = 'components/' . $nameComponent . '/';

        $controllerFile = $pathComponent . $nameComponent . 'Controller.php';
        $modelFile = $pathComponent . '/' . $nameComponent . 'Model.php';

        if (file_exists($modelFile)) {
            include $modelFile;
        }
        //var_dump($controllerFile);
        if (file_exists($controllerFile)) {
            include $controllerFile;

            $controller = new signInController();
            if (method_exists($controller, 'actionIndex')) {

                $controller->actionIndex($pathComponent . '/');
            } else {
                echo 'нет метода';
            }
        } else {
            echo 'Компонент не найден';
        }

    }
}

?>