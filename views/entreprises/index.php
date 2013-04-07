<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Branches</th>
			<th>Villes</th>
			<th>Stages</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $e): ?>
			<tr>
				<td><a href="/entreprises/<?= $e['eid'] ?>"><?= $e['nom'] ?></a></td>
				<td><?= $e['branches'] ?></td>
				<td><?= $e['villes'] ?></td>
				<td><?= $e['stages'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
