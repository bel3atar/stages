<? class Sessions extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('session');
		$this->model = new SessionModel();
	}
	function add()
	{
		if (Session::get('logged'))
			header('Location: ' . URL);
		else {
			$this->view->title = 'Se connecter';
			$this->view->render('sessions/new');
		}
	}
	function create()
	{
		$r = $this->model->find($_POST['login'], $_POST['password']);
		if ($r) {
			$_SESSION['is_admin'] = $r['is_admin'];
			  $_SESSION['logged'] = TRUE;
			     $_SESSION['nom'] = $r['nom'];
			      $_SESSION['id'] = $r['id'];
			Flash::info('Bienvenue.');
			header('Location: ' . URL);
		} else {
			Flash::error('Mauvais Email ou mot de passe.');
			header('Location: ' . URL . 'sessions/new');
		}
	}
	function destroy()
	{
		session_unset();
		Flash::info('Merci pour votre visite.');
		header('Location: ' . URL . 'sessions/new');
	}
};
