<legend>Entreprises à <?= $this->ville ?></legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<td>Nom</td>
			<td>Téléphone</td>
			<td>Adresse</td>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $e): ?>
			<tr>
				<td><a href="/entreprises/<?= $e['eid'] ?>"><?= $e['nom'] ?></a></td>
				<td><?= $e['tel'] ?></td>
				<td><?= $e['adr'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
