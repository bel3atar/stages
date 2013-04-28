<div class="page-header"><h1>Liste des responsables</h1></div>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom complet</th>
			<th>Email</th>
			<th>Entreprise</th>
			<th>Propositions</th>
			<th>Supervisions</th>
			<? if (Session::get('is_admin')) echo '<th></th>' ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $p): ?>
			<tr>
				<td><?= $p['nom'] ?></td>
				<td><?= $p['email'] ?></td>
				<td>
					<a href="<?= URL ?>entreprises/<?= $p['eid'] ?>">
						<?= $p['entreprise'] ?>
					</a>
				</td>
				<td><?= $p['propositions'] ?></td>
				<td><?= $p['supervisions'] ?></td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>people/<?= $p['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<? if ($p['propositions'] == 0 and $p['supervisions'] == 0): ?>
								<a href="<?= URL ?>people/<?= $p['id'] ?>/destroy" class="btn btn-danger btn-mini">
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
<a href="<?= URL ?>people/new" class="pull-right btn btn-primary">
	<i class="icon-plus-sign icon-white"></i>
	Nouveau
</a>
