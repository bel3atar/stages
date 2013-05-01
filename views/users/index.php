<div class="page-header"><h1>Liste des étudiants</h1></div>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom complet</th>
			<th>Option</th>
			<th>Email</th>
			<th>Stages</th>
			<? if (Session::get('is_admin')): ?>
				<th></th>
			<? endif ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $etd): ?>
			<tr>
				<td>
					<a href="<?= URL ?>users/<?= $etd['id'] ?>">
						<?= $etd['nom'] ?>
					</a>
				</td>
				<td>
					<a href="<?= URL ?>options/<?= $etd['optid'] ?>/students"><?= $etd['opt'] ?></a>
				</td>
				<td><?= $etd['email'] ?></td>
				<td>
					<? if ($etd['stages']): ?>
						<a href="<?= URL ?>users/<?= $etd['id'] ?>/stages">
							<?= $etd['stages'] ?>
						</a>
					<? else: ?>
						0
					<? endif ?>
				</td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>users/<?= $etd['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<? if ($etd['stages'] == 0 and Session::get('is_admin')): ?>
								<a href="<?= URL ?>users/<?= $etd['id'] ?>/destroy" class="btn btn-danger btn-mini">
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
	<a href="<?= URL ?>users/new" class="pull-right btn btn-primary">
		<i class="icon-white icon-plus-sign"></i>
		Nouveau
	</a>
<? endif ?>
<? require 'views/pager.php' ?>
