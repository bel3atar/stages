<?
class Technologies extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('technology');
		$this->model = new TechnologyModel();
	}
	function index()
	{
		$this->view->title = 'Liste des technologies';
		$this->view->list  = $this->model->find_all();
		$this->view->render('technologies/index');
	}
	function show($id)
	{
		$this->view->list = $this->model->find_stages($id);
		$this->view->title = $this->model->find_name($id);
		$this->view->render('technologies/show');
	}
	function add()
	{
		$this->view->title = 'Nouvelle technologie';
		$this->view->render('technologies/new');
	}
};
?>
