<?
define('URL', 'http://localhost/');
define('PAGE_SIZE', 10);
define('PAGER_SIZE', 3);
require_once "core/application.php";
$app = new Application(isset($_GET['url']) ? rtrim($_GET['url'], '/') : NULL);
?>
