<?
class Users extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('user');
		$this->model = new UserModel();
	}
	function index()
	{
		$this->view->title = 'Liste des étudinats';
		$this->view->liste = $this->model->findAll();
		$this->view->render('users/index');
	}
	function show($id)
	{
		echo "show $id";
	}
	function edit($id)
	{
		echo "edit $id";
	}
	function add()
	{
		$this->view->title = 'Nouvel étudiant';
		$this->require_model('option');
		$opmodel = new OptionModel();
		$this->view->options = $opmodel->find_all();
		$this->view->render('users/new');
	}
};
