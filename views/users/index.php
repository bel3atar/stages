<table class="table table-condensed table-hover" border="0">
	<thead>
		<tr>
			<th>Matricule</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $etd): ?>
			<tr>
				<td><?= $etd['id']; ?></td>
				<td><?= $etd['nom']; ?></td>
				<td><?= $etd['prenom']; ?></td>
				<td><?= $etd['email']; ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>

