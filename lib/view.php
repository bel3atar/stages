<?
class View {
	function render($view, $edges = true)
	{
		if ($edges)
			require "{$_SERVER['DOCUMENT_ROOT']}/views/_header.php";
		require "{$_SERVER['DOCUMENT_ROOT']}/views/{$view}.php";
	}
};
