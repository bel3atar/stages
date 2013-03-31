<?
class View {
	function render($view, $edges = true)
	{
		if ($edges)
			require_once "{$_SERVER['DOCUMENT_ROOT']}/views/_header.php";
		require_once "{$_SERVER['DOCUMENT_ROOT']}/views/{$view}.php";
		if ($edges)
			require_once "{$_SERVER['DOCUMENT_ROOT']}/views/_footer.php";
	}
};
