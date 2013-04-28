<div class='page-header'>
  <h1>Liste des villes</h1>
</div>
<table class="table table-hover table-striped table-condensed">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Stages</th>
			<? if (Session::get('is_admin')) echo '<th></th>' ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $ville): ?>
			<tr>
				<td>
					<? if ($ville['stages']): ?>
						<a href="<?= URL ?>cities/<?= $ville['id'] ?>/stages"><?= $ville['nom'] ?></a>
					<? else: ?>
						<?= $ville['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($ville['stages']): ?>
						<a href="<?= URL ?>cities/<?= $ville['id'] ?>/stages"><?= $ville['stages'] ?></a>
					<? else: ?>
						<?= $ville['stages'] ?>
					<? endif ?>
				</td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>cities/<?= $ville['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<? if ($ville['stages'] == 0): ?>
								<a href="<?= URL ?>cities/<?= $ville['id'] ?>/destroy" class="btn btn-danger btn-mini">
									<i class="icon-white icon-trash"></i>
								</a>
							<? endif ?>
						</div>
					</td>
				<? endif ?>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<? if (Session::get('logged')): ?>
	<a href="<?= URL ?>cities/new" class="pull-right btn btn-primary">
		<i class="icon-plus-sign icon-white"></i>
		Nouvelle
	</a>
<? endif ?>
