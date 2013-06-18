<? class Search extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('search');
		$this->model = new SearchModel();
		$this->view->controller = 'search';
	}
	function index()
	{
		$this->view->title        = 'Recherche';
		$this->view->technologies = $this->model->technologies();
		$this->view->cities       = $this->model->cities();
		$this->view->stylesheets  = ['tagmanager/bootstrap-tagmanager'];
		$this->view->render('search/index', FALSE);
	}
	function run()
	{
		$this->view->title = 'Résultats de la recherche';
		$this->view->list  = $this->model->find($_POST);
		$this->view->render('search/show');
	}
};
