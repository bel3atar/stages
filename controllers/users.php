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
		$this->view->liste = $this->model->findAll();
		$this->view->render('users/index');
	}
	function stages($id)
	{
		$this->view->nom = $this->view->title = $this->model->full_name($id);
		$this->view->list  = $this->model->stages($id);
		$this->view->render('users/stages');
	}
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
		$u = $this->model->find($id);
		print_r($u);
		exit;
		$this->view->title = "{$u['nom']} | Profil";
		$this->view->render('users/show');
	}
};
