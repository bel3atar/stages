<?
class Students extends Controller {
	function __construct()
	{
		parent::__construct();
		require "{$_SERVER['DOCUMENT_ROOT']}/models/student.php";
		$this->model = new StudentModel();
	}
	function index()
	{
		$this->view->liste = $this->model->findAll();
		$this->view->render('students/index');
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
