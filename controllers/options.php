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
		$this->view->list  = $this->model->find_all();
		$this->view->render('options/index');
	}
	function add()
	{
		$this->view->title = 'Nouvelle option';
		$this->view->render('options/new');
	}
	function create()
	{
		if (Session::get('logged'))
			$this->model->create();
		header('Location: /options');
	}
	function students($id)
	{
		$name = $this->model->name($id);
		$this->view->title = "Etudiants pour $name";
		$this->view->list  = $this->model->find($id);
		$this->view->render('options/students');
	}
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
		header('Location: /options');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			$this->model->delete($id);
		header('Location: /options');
	}
};
