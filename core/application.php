<?
class Application {
	function __construct($url)
	{
		require_once 'model.php';
		require_once 'view.php';
		require_once 'controller.php';
		if (empty($url)) {
			require_once "{$_SERVER['DOCUMENT_ROOT']}/controllers/index.php";
			$controller = new Index();
		} else {
			$bits = explode('/', $url);
			$target = "{$_SERVER['DOCUMENT_ROOT']}/controllers/{$bits[0]}.php";
			if (file_exists($target)) {
				require_once $target;
				$name = $bits[0];
				$controller = new $name();
				if (isset($bits[1])) {
					if (preg_match('/^\d+$/', $bits[1]))
						if (isset($bits[2])) {
							if ($bits[2] == 'edit')
								$controller->edit($bits[1]);
						} else
							$controller->show($bits[1]);
					else if ($bits[1] == 'new')
						$controller->add();
					else {
						$action = $bits[1];
						$controller->$action();
					}
				}	else
					$controller->index();
			} else {
				require "{$_SERVER['DOCUMENT_ROOT']}/controllers/error.php";
				$controller = new Error($url);
			}
		}
	}
};
