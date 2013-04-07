<?
class Cities extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('city');
		$this->model = new CityModel();
	}
	function index()
	{
		$this->view->title = 'Liste des villes';
		$this->view->list  = $this->model->find_all();
		$this->view->render('cities/index');
	}
};
