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
};
?>
