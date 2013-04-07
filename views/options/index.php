<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Etudiants</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $option): ?>
			<tr>
				<td><?= $option['nom'] ?></td>
				<td><?= $option['etudiants'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
