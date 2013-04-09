<legend><?= $this->title ?></legend>
<table class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th>Matricule</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Sexe</th>
			<th>Né(e) le</th>
			<th>Téléphone</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $e): ?>
			<tr>
				<td><?= $e['id'] ?></td>
				<td><?= $e['nom'] ?></td>
				<td><?= $e['prenom'] ?></td>
				<td><?= $e['sex'] ?></td>
				<td><?= $e['ne_le'] ?></td>
				<td><?= $e['tel'] ?></td>
				<td><?= $e['email'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
