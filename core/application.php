<?
class Application {
	function __construct($url)
	{
		require_once 'model.php';
		require_once 'view.php';
		require_once 'controller.php';
		if (empty($url)) {
			require_once 'controllers/stages.php';
			$controller = new Stages();
			$controller->index();
		} else {
			/* bits    0     1    2
			 * -----------------------------
			 *      cities / 1 / edit
			 *      cities / 1 / stages
			 *      cities / 1 / entreprises
			 *      cities /new
			 */
			$bits = explode('/', $url);
			$target = "controllers/{$bits[0]}.php";
			try {
				if (!file_exists($target))
					throw new Exception();
				require_once $target;
				$controller = $bits[0];
				$controller = new $controller();
				switch (sizeof($bits)) {
					case 1: $action = 'index'; break;
					case 2:
						if (preg_match('/^\d+$/', $bits[1])) {
							if ($controller->model->exists($bits[1]) == 0)
								throw new Exception();
							$action = 'show';
						} else
							$action = $bits[1] === 'new' ? 'add' : $bits[1];
						break;
					case 3: 
						if (preg_match('/^\d+$/', $bits[1])) {
							if ($controller->model->exists($bits[1]) == 0)
								throw new Exception();
							$action = $bits[2];
						} else
							throw new Exception();
						break;
					default: throw new Exception();
				}
				if (!method_exists($controller, $action))
					throw new Exception();
				if (sizeof($bits) == 1)
					$controller->index();
				else { 
					$controller->$action($bits[1]);
				}
			}	catch (Exception $e) {
				require_once 'controllers/error.php';
				$controller = new Error($url);
			}
		}
	}
};
