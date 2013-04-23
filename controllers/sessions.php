<? class Sessions extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('session');
		$this->model = new SessionModel();
	}
	function add()
	{
		$this->view->title = 'Se connecter';
		$this->view->render('sessions/new');
	}
	function create()
	{
		$r = $this->model->find($_POST['login'], $_POST['password']);
		if ($r) {
			$_SESSION['is_admin'] = $r['is_admin'];
			  $_SESSION['logged'] = TRUE;
			     $_SESSION['nom'] = $r['nom'];
			      $_SESSION['id'] = $r['id'];
			header('Location: /');
		} else
			header('Location: /sessions/new');
	}
	function destroy()
	{
		session_unset();
		session_destroy();
		header('Location: /sessions/new');
	}
};
