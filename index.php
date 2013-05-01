<?
require_once 'config.inc.php';
require_once 'core/application.php';
$app = new Application(isset($_GET['url']) ? rtrim($_GET['url'], '/') : NULL);
?>
