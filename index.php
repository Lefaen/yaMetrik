<?

class project {
    public $user;
    public static $userHref;

    static function startInclude(){

        require_once '/classes/mvc/modelBase.php';
        require_once '/classes/mvc/viewBase.php';
        require_once '/classes/mvc/controllerBase.php';
        require_once '/classes/mvc/route.php';
        require_once '/classes/mvc/component.php';
        require_once '/classes/user.php';
        require_once '/classes/sqlClass.php';
    }

    function __construct()
    {
        session_start();
        if($_GET['action'] == 'logout')
        {
            session_destroy();
        }
        ini_set('display_errors', 1);

        self::startInclude();

        $this->user = new user();
        self::$userHref = &$this->user;

        Route::start();//prepare routing
        sqlClass::start();//prepare tables in sql

    }
}

$project = new project();



?>