<? class Options extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('option');
		$this->model = new OptionModel();
	}
	function index()
	{
		$this->view->title = 'Liste des options';
		$this->view->list  = $this->model->find_all();
		$this->view->render('options/index');
	}
};
