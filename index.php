<?
require_once "{$_SERVER['DOCUMENT_ROOT']}/lib/application.php";
$app = new Application(isset($_GET['url'])?rtrim($_GET['url']):null, '/');
?>
