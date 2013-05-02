<? if (Session::get('notice')): ?> 
	<? foreach ($_SESSION['notice'] as $type => $msg): ?>
		<div class='alert alert-<?= $type ?>'>
			<strong>
				<? switch($type) {
					case 'error': echo 'Erreur!'; break;
					case 'success': echo 'Succès!'; break;
					case 'info': echo 'Information!'; 
				} ?>
			</strong>
			<?= $msg ?>
		</div>
		<? ?>
	<? endforeach; unset($_SESSION['notice']) ?>
<? endif ?>
