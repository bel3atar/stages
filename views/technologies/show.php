<legend>Stages pour <?= $this->title ?></legend>
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Ville</th>
		</tr>
	</thead>
<tbody>
	<? foreach ($this->list as $t): ?>
		<tr>
			<td>
				<a href="/entreprises/<?= $t['eid'] ?>">
					<?= $t['entreprise'] ?>
				</a>
			</td>
			<td><?= $t['date'] ?></td>
			<td><?= $t['duree'] ?></td>
			<td><?= $t['ville'] ?></td>
		</tr>
	<? endforeach ?>
</tbody>
</table>
