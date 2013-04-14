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
	function render($view, $edges = TRUE)
	{
		if ($edges) {
			require_once "views/_header.php";
			require_once "views/{$view}.php";
			require_once "views/_footer.php";
		} else 
			require_once "views/{$view}.php";
	}
};
