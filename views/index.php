<legend>Derniers stages</legend>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Ville</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $stage): ?>
			<tr>
				<td><?= $stage['entreprise'] ?></td>
				<td><?= $stage['date'] ?></td>
				<td><?= $stage['duree'] * 15 ?></td>
				<td><?= $stage['ville'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
