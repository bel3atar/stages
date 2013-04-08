<?
require_once "{$_SERVER['DOCUMENT_ROOT']}/core/application.php";
$app = new Application(isset($_GET['url']) ? rtrim($_GET['url']) : null, '/');
?>
