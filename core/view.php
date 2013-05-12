<?
class View {
	private $controllers = [
		'stages'       => ['label' => 'Stages'      , 'icon' => 'icon-certificate'],
	 	'entreprises'  => ['label' => 'Entreprises' , 'icon' => 'icon-barcode'],
		'users'        => ['label' => 'Etudiants'   , 'icon' => 'icon-user'],
		'people'       => ['label' => 'Responsables', 'icon' => 'icon-star'],
		'technologies' => ['label' => 'Technologies', 'icon' => 'icon-cog'],
		'options'      => ['label' => 'Options'     , 'icon' => 'icon-th'],
		'cities'       => ['label' => 'Villes'      , 'icon' => 'icon-map-marker']
	];
	function render($view, $footer = TRUE)
	{
		             require_once "views/shared/_header.php";
		             require_once "views/{$view}.php";
		if ($footer) require_once "views/shared/_footer.php";
	}
	function render_($partial)
	{
		require "views/shared/_{$partial}.php";
	}
};
