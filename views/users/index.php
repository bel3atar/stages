<legend>Liste des étudiants</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Matricule</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Sexe</th>
			<th>Né(e) le</th>
			<th>Opt.</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Stages</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $etd): ?>
			<tr>
				<td><?= $etd['id'] ?></td>
				<td><?= $etd['nom'] ?></td>
				<td><?= $etd['prenom'] ?></td>
				<td><?= $etd['sex'] ?></td>
				<td><?= $etd['ne_le'] ?></td>
				<td>
					<a href="/options/<?= $etd['optid'] ?>"><?= $etd['opt'] ?></a>
				</td>
				<td><?= $etd['tel'] ?></td>
				<td><?= $etd['email'] ?></td>
				<td><?= $etd['stages'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/users/new" class="btn">Nouveau</a>
