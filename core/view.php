<?
class View {
	private $controllers = [
		'stages'       => 'Stages',
	 	'entreprises'  => 'Entreprises',
		'users'        => 'Etudiants',
		'people'       => 'Responsables',
		'technologies' => 'Technologies',
		'options'      => 'Options',
		'cities'       => 'Villes'
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
