<?
class Stages extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('stage');
		$this->model = new StageModel();
		$this->view->controller = 'stages';
	}
	function show($id)
	{
		$this->view->title = 'Détails du stage';
		$ls = glob("assets/reports/$id.*");
		$this->view->stage = $this->model->find($id);
		if ($ls)
			$this->view->stage['rapport'] = $ls[0];
		$this->view->render('stages/show');
	}
	function add()
	{
		$this->view->title        = 'Nouveau stage';
		$this->view->entreprises  = $this->model->entreprises();
		$this->view->technologies = $this->model->technologies();
		$this->view->users        = $this->model->users();
		$this->view->people       = $this->model->people();
		$this->view->cities       = $this->model->cities();
		$this->view->stylesheets  = ['tagmanager/bootstrap-tagmanager'];
		$this->view->render('stages/new', FALSE);
	}
	function index()
	{
		$this->view->title = 'Liste des stages';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('stages/index');
	}
	private function get_extension($f)
	{
		$ms = [
			'application/x-ace-compressed' => '.ace',
			'application/x-rar-compressed' => '.rar',
			'application/x-7z-compressed'  => '.7z',
			'application/x-bzip2'          => '.tar.bz',
			'application/x-gzip'           => '.tar.gz',
			'application/x-lzma'           => '.tar.lzma',
			'application/x-tar'            => '.tar',
			'application/x-xz'             => '.xz',
			'application/zip'              => '.zip'
		];
		$m = (new finfo(FILEINFO_MIME_TYPE))->file($f);
		return in_array($m, array_keys($ms)) ? $ms[$m] : NULL;
	}
	function create()
	{
		if (Session::get('is_admin') or Session::get('id') == $_POST['user']) {
			$ext = NULL;
			$f = $_FILES['report']['tmp_name'];
			if (is_uploaded_file($f))
				$ext = $this->get_extension($f);
			if ($this->model->create($_POST)) {
				if ($ext) {
					$id = $this->model->lastID();
					move_uploaded_file($f, "assets/reports/$id$ext");
					Flash::success('Stage enregistré avec rapport.');
				} else
					Flash::success('Stage enregistré sans rapport.');
			} else
				Flash::error('Création du stage non effectuée.');
			header('Location: ' . URL . 'stages');
		} else
			$this->unauthorised();
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			if ($this->model->destroy($id)) {
				$rapport = glob("assets/reports/$id.*");
				unlink($rapport[0]);
				Flash::success('Le stage a bien été supprimé.');
			}
			else
				Flash::error('La suppression du stage n\'a pas abouti.');
			header('Location: ' . URL . 'stages');
		} else
			$this->unauthorised();
	}
	function edit($id)
	{
		$this->view->title = 'Modifier un stage';
		$this->view->stage = $this->model->find($id);
		$this->view->entreprises  = $this->model->entreprises();
		$this->view->technologies = $this->model->technologies();
		$this->view->users        = $this->model->users();
		$this->view->people       = $this->model->people();
		$this->view->cities       = $this->model->cities();
		$this->view->stylesheets  = ['tagmanager/bootstrap-tagmanager'];
		$this->view->render('stages/edit', FALSE);
	}
	function update()
	{
		if (Session::get('is_admin') or $_POST['user'] == Session::get('id')) {
			$ext = NULL;
			$f = $_FILES['rapport']['tmp_name'];
			if (is_uploaded_file($f))
				$ext = $this->get_extension($f);
			if ($this->model->update($_POST)) {
				if ($ext) {
					$old = glob("assets/reports/{$_POST['id']}.*")[0];
					unlink($old);
					move_uploaded_file($f, "assets/reports/{$_POST['id']}$ext");
					Flash::success('Stage (rapport inclus) mis à jour avec succès.');
				} else
					Flash::success('Stage mis à jour avec succès (pas de mise à jour du rapport).');
			} else
				Flass::error('La mise à jour n\'a pas été effectuée.');
			header('Location: ' . URL . 'stages');
		} else
			$this->unauthorised();
	}
	function _count() { return $this->model->count(); }
};
