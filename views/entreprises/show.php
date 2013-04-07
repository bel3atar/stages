<legend><?= $this->entreprise['nom'] ?></legend>
<img src="<?= $this->entreprise['logo'] ?>" class="img-polaroid">
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Téléphone</th>
			<th>Adresse</th>
			<th>Ville</th>
		</tr>
	<thead>
	<tbody>
		<? foreach ($this->branches as $b): ?>
			<tr>
				<td><?= $b['tel']?></td>
				<td><?= $b['adr']?></td>
				<td><?= $b['ville']?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
