<?
class Users extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('user');
		$this->model = new UserModel();
		$this->view->controller = 'users';
	}
	function index()
	{
		$this->view->title = 'Liste des étudinats';
		$this->view->liste = $this->model->findAll($this->page());
		$this->view->render('users/index');
	}
	function stages($id)
	{
		$this->view->nom = $this->view->title = $this->model->full_name($id);
		$this->view->list  = $this->model->stages($id, $this->page());
		$this->view->render('users/stages');
	}
	function _count() { return $this->model->count(); }
	function stages_count($id) { return $this->model->stages_count($id); }
	function add()
	{
		$this->view->title = 'Nouvel étudiant';
		$this->require_model('option');
		$opmodel = new OptionModel();
		$this->view->options = $opmodel->find_all();
		$this->view->render('users/new');
	}
	function create()
	{
		if (Session::get('is_admin'))
			$this->model->create($_GET);
		header('Location: ' . URL . 'users');
	}
	function show($id)
	{
		$this->view->user  = $this->model->find($id);
		$this->view->title = "{$this->view->user['nom']} | Profil";
		$this->view->render('users/show');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			$this->model->destroy($id);
		header('Location: ' . URL . 'users');
	}
	function edit($id)
	{
		$this->view->title = 'Modifier un utilisateur';
		$this->view->user = $this->model->find($id);
		$this->require_model('option');
		$opmodel = new OptionModel();
		$this->view->options = $opmodel->find_all();
		$this->view->render('users/edit');
	}
	function update()
	{
		if (Session::get('logged'))
			if (Session::get('is_admin') or Session::get('id') == $_POST['id']) {
				$this->model->update($_POST);
				$_SESSION['nom'] = $this->model->full_name($_SESSION['id']);
			}
		header('Location: ' . URL . 'users');
	}
};
