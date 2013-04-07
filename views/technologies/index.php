<legend>Liste des technologies</legend>
<table cellspacing="0">
	<thead>
		<tr>
			<th>Nom</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $t): ?>
			<tr>
				<td><?= $t['nom'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
