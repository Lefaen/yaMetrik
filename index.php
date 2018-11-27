<?
session_start();

class project {
    public $user;
    public static $userHref;

    static function startInclude(){

        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/mvc/modelBase.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/mvc/viewBase.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/mvc/controllerBase.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/mvc/route.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/mvc/component.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/user.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/sqlClass.php';
    }

    function __construct()
    {

        if($_GET['action'] == 'logout')
        {
            session_destroy();
        }
        ini_set('display_errors', 0);

        self::startInclude();

        $this->user = new user();
        self::$userHref = &$this->user;

        Route::start();//prepare routing
        sqlClass::start();//prepare tables in sql

    }
}

$project = new project();



?>