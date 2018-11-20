<?php

class component
{
    static public function includeComponent($nameComponent)
    {
        $pathComponent = 'components/' . $nameComponent . '/';

        $controllerFile =$_SERVER['DOCUMENT_ROOT'].'/'. $pathComponent . $nameComponent . 'Controller.php';
        $modelFile = $_SERVER['DOCUMENT_ROOT'].'/'. $pathComponent . $nameComponent . 'Model.php';


        if (file_exists($modelFile)) {
            include $modelFile;
        }
        //var_dump($controllerFile);
        if (file_exists($controllerFile)) {
            include $controllerFile;
            $component = $nameComponent.'controller';
            $controller = new $component;
            if (method_exists($controller, 'actionIndex')) {
                $controller->actionIndex($_SERVER['DOCUMENT_ROOT'].'/'.$pathComponent . '/');
            } else {
                echo 'нет метода';
            }
        } else {
            echo 'Компонент не найден';
        }

    }
}

?>