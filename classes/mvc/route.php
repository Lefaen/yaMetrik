<?

class Route
{
    static function start()
    {
        //default index.php
        $pathPages = $_SERVER['DOCUMENT_ROOT'].'/pages/';
        $controllerPath = 'main';
        //$action_name = 'index';

        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $routes = explode('/', $uri[0]);

        if (!empty($routes[1])) {
            $controllerPath = $routes[1];
        }

        $controllerFile = $pathPages . $controllerPath . '/controller.php';
        $modelFile = $pathPages . $controllerPath . '/model.php';

        if(file_exists($modelFile))
        {
            include $modelFile;
        }
        //var_dump($controllerFile);
        if(file_exists($controllerFile))
        {
            include $controllerFile;

            $controller = new controller();
            if(method_exists($controller, 'actionIndex'))
            {
                $controller->actionIndex($pathPages . $controllerPath);
            }
            else
            {
                echo 'нет метода';
            }
        }
        elseif(strpos($_SERVER['REQUEST_URI'], '.xlsx') != false)
        {
            //Route::ErrorPage404();
        }
        else
        {
            Route::ErrorPage404();
        }




    }

    function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        include '404.php';
        //header('Location:' . $host . '404');
    }
}

?>