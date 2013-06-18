<? class Stats extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('stat');
		$this->model = new StatModel();
	}
	function index()
	{
		$this->view->arr = $this->model->find_all();
		$this->view->title = 'Statistiques';
		$this->view->render('stats');
	}
};
