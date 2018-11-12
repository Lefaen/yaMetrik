<?
session_start();
if($_GET['action'] == 'logout')
{
    session_destroy();
}
ini_set('display_errors', 1);

require_once '/classes/mvc/modelBase.php';
require_once '/classes/mvc/viewBase.php';
require_once '/classes/mvc/controllerBase.php';
require_once '/classes/mvc/route.php';
require_once '/classes/mvc/component.php';
require_once '/classes/user.php';
require_once '/classes/sqlClass.php';

Route::start();//prepare routing
sqlClass::start();//prepare tables in sql
$user = new user();

?>