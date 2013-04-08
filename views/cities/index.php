<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Stages</th>
			<th>Entreprises</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $ville): ?>
			<tr>
				<td><?= $ville['nom'] ?></td>
				<td><?= $ville['stages'] ?></td>
				<td><?= $ville['entreprises'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/cities/new" class="btn">Nouvelle</a>
