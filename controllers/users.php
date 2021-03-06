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
		$this->view->nom  = $this->view->title = $this->model->full_name($id);
		if ($this->view->list = $this->model->stages($id, $this->page()))
			$this->view->render('users/stages');
		else {
			Flash::error('Cet étudiant n\'a pas de stages.');
			header('Location: '. URL . "users/$id");
		}
	}
	function _count() { return $this->model->count(); }
	function stages_count($id) { return $this->model->stages_count($id); }
	function add()
	{
		$this->view->title = 'Nouvel étudiant';
		$this->view->options = $this->model->options();
		$this->view->render('users/new');
	}
	function create()
	{
		if (Session::get('is_admin')) {
			if ($this->model->create($_GET))
				Flash::success('L\'utilisateur a bien été créé.');	
			else
				Flash::error('L\'utilisateur n\'a pas été créé.');
			header('Location: ' . URL . 'users');
		} else
			$this->unauthorised();
	}
	function show($id)
	{
		$this->view->user  = $this->model->find($id);
		$this->view->title = "{$this->view->user['nom']} | Profil";
		$this->view->render('users/show');
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			if ($this->model->destroy($id))
				Flash::success('La suppression de l\'utilisateur a bien été effectuée.');
			else
				Flash::error('La suppression de l\'utilisateur n\'a pas abouti.');
			header('Location: ' . URL . 'users');
		} else
			$this->unauthorised();
	}
	function edit($id)
	{
		$this->view->title = 'Modifier un utilisateur';
		$this->view->user = $this->model->find($id);
		$this->view->options = $this->model->options();
		$this->view->render('users/edit');
	}
	function update()
	{
		if (Session::get('is_admin') or Session::get('id') == $_POST['id']) {
			if ($this->model->update($_POST)) {
				$_SESSION['nom'] = $this->model->full_name($_SESSION['id']);
				Flash::success('Profil utilisateur mis à jour.');
			} else
				Flash::error('La mise à jour du profil utilisateur n\'a pas été effectuée.');
			header('Location: ' . URL . 'users');
		} else
			$this->unauthorised();
	}
};
