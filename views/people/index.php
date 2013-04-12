<legend>Liste des responsables</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom complet</th>
			<th>Email</th>
			<th>Entreprise</th>
			<th>Propositions</th>
			<th>Supervisions</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $p): ?>
			<tr>
				<td><?= $p['nom'] ?></td>
				<td><?= $p['email'] ?></td>
				<td>
					<a href="/entreprises/<?= $p['eid'] ?>">
						<?= $p['entreprise'] ?>
					</a>
				</td>
				<td><?= $p['propositions'] ?></td>
				<td><?= $p['supervisions'] ?></td>
				<td>
					<div class="btn-group">
						<a href="/people/<?= $p['id'] ?>/edit" class="btn btn-warning btn-mini">
							<i class="icon-white icon-edit"></i>
						</a>
						<? if ($p['propositions'] == 0 and $p['supervisions'] == 0): ?>
							<a href="/people/<?= $p['id'] ?>/destroy" class="btn btn-danger btn-mini">
								<i class="icon-white icon-trash"></i>
							</a>
						<? endif ?>
					</div>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/people/new" class="btn btn-primary">
	<i class="icon-plus-sign icon-white"></i>
	Nouveau
</a>
