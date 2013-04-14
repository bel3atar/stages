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
		$this->model->create();
		header('Location: /technologies');
	}
	function edit($id)
	{
		$this->view->id  = $id;
		$this->view->nom = $this->model->find_name($id);
		$this->view->render('technologies/edit');
	}
	function update()
	{
		$this->model->update($_GET);
		header('Location: /technologies');
	}
	function destroy($id)
	{
		$this->model->destroy($id);
		header('Location: /technologies');
	}
};
?>
