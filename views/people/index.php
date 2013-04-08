<legend>Liste des responsables</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
			<th>Entreprise</th>
			<th>Propositions</th>
			<th>Supervisions</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $p): ?>
			<tr>
				<td><?= $p['nom'] ?></td>
				<td><?= $p['prenom'] ?></td>
				<td><?= $p['email'] ?></td>
				<td>
					<a href="/entreprises/<?= $p['eid'] ?>">
						<?= $p['entreprise'] ?>
					</a>
				</td>
				<td><?= $p['propositions'] ?></td>
				<td><?= $p['supervisions'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/people/new" class="btn">Nouveau</a>
