<div class="page-header"><h1>Derniers stages</h1></div>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>Etudiant</th>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Ville</th>
			<th>Technologies</th>
			<? if (Session::get('is_admin')) echo '<th></th>' ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $stage): ?>
			<tr>
				<td>
					<a href="<?= URL ?>users/<?= $stage['uid'] ?>">
						<?= $stage['nom'] ?>
					</a>
				</td>
				<td>
					<a href="<?= URL ?>entreprises/<?= $stage['eid'] ?>">
						<?= $stage['entreprise'] ?>
					</a>
				</td>
				<td><?= $stage['date'] ?></td>
				<td><?= $stage['duree'] ?></td>
				<td>
					<a href="<?= URL ?>cities/<?= $stage['idville'] ?>/stages">
						<?= $stage['ville'] ?>
					</a>
				</td>
				<td>
					<? $ts = explode(',', $stage['techs']) ?>
					<? $tids = explode(',', $stage['techids']) ?>
					<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
						<a href="<?= URL ?>technologies/<?= $tids[$i] ?>/stages">
						<?= $ts[$i] ?></a><?= $i ? ', ' : '' ?>
					<? endfor ?>
				</td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>stages/<?= $stage['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<a href="<?= URL ?>stages/<?= $stage['id'] ?>/destroy" class="btn btn-danger btn-mini">
								<i class="icon-white icon-trash"></i>
							</a>
						</div>
					</td>
				<? endif ?>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<? if (Session::get('logged')): ?>
	<a href="<?= URL ?>stages/new" class="pull-right btn btn-primary">
		<i class="icon-plus-sign icon-white"></i>
		Nouveau
	</a>
<? endif ?>
