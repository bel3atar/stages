<div class="page-header"><h1>Liste des technologies</h1></div>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Stages</th>
			<? if (Session::get('logged')) echo '<th></th>' ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $t): ?>
			<tr>
				<td>
					<? if ($t['stages']): ?>
						<a href="<?= URL ?>technologies/<?= $t['id'] ?>/stages">
							<?= $t['nom'] ?>
						</a>
					<? else: ?>
						<?= $t['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($t['stages']): ?>
						<a href="<?= URL ?>technologies/<?= $t['id'] ?>/stages">
							<?= $t['stages'] ?>
						</a>
					<? else: ?>
						<?= $t['stages'] ?>
					<? endif ?>
				</td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>technologies/<?= $t['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<? if ($t['stages'] == 0): ?>
								<a href="<?= URL ?>technologies/<?= $t['id'] ?>/destroy" class="btn btn-danger btn-mini">
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
	<a href="<?= URL ?>technologies/new" class="pull-right btn btn-primary">
		<i class="icon-plus-sign icon-white"></i>
		Nouvelle
	</a>
<? endif ?>
<? $this->render_('pager') ?>
