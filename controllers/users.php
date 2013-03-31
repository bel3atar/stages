<?
class Users extends Controller {
	function __construct()
	{
		parent::__construct();
		require "{$_SERVER['DOCUMENT_ROOT']}/models/user.php";
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
		echo 'add';
	}
};
