<?
class Technologies extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('technology');
		$this->model = new TechnologyModel();
		$this->view->controller = 'technologies';
	}
	function index()
	{
		$this->view->title = 'Liste des technologies';
		$this->view->list  = $this->model->find_all();
		$this->view->render('technologies/index');
	}
	function stages($id)
	{
		$this->view->list = $this->model->stages($id);
		$this->view->title = $this->model->find_name($id);
		$this->view->render('technologies/stages');
	}
	function add()
	{
		$this->view->title = 'Nouvelle technologie';
		$this->view->render('technologies/new');
	}
	function create()
	{
		if (Session::get('logged'))
			$this->model->create();
		header('Location: ' . URL . 'technologies');
	}
	function edit($id)
	{
		$this->view->id  = $id;
		$this->view->nom = $this->model->find_name($id);
		$this->view->render('technologies/edit');
	}
	function update()
	{
		if (Session::get('is_admin'))
			$this->model->update($_GET);
		header('Location: ' . URL . 'technologies');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			$this->model->destroy($id);
		header('Location: ' . URL . 'technologies');
	}
};
?>
