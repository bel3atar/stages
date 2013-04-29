<? class Options extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('option');
		$this->model = new OptionModel();
		$this->view->controller = 'options';
	}
	function index()
	{
		$this->view->title = 'Liste des options';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('options/index');
	}
	function _count() { return $this->model->count(); }
	function add()
	{
		$this->view->title = 'Nouvelle option';
		$this->view->render('options/new');
	}
	function create()
	{
		if (Session::get('logged'))
			$this->model->create();
		header('Location: ' . URL . 'options');
	}
	function students($id)
	{
		$this->view->name = $this->model->name($id);
		$this->view->title = "{$this->view->name} | Etudiants";
		$this->view->list  = $this->model->find($id, $this->page());
		$this->view->render('options/students');
	}
	function students_count($id) { return $this->model->students_count($id); }
	function edit($id)
	{
		$this->view->nom   = $this->model->name($id);
		$this->view->id    = $id;
		$this->view->title = "Modifier une option";
		$this->view->render('options/edit');
	}
	function update($id)
	{
		if (Session::get('is_admin'))
			$this->model->update($_GET);
		header('Location: ' . URL . 'options');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			$this->model->delete($id);
		header('Location: ' . URL . 'options');
	}
};
