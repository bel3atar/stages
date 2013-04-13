<legend>Stages pour <?= $this->title ?></legend>
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>Etudiant</th>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Ville</th>
		</tr>
	</thead>
<tbody>
	<? foreach ($this->list as $t): ?>
		<tr>
			<td><a href="/users/<?= $t['uid'] ?>/stages"><?= $t['etudiant'] ?></a></td>
			<td>
				<a href="/entreprises/<?= $t['eid'] ?>/stages">
					<?= $t['entreprise'] ?>
				</a>
			</td>
			<td><?= $t['date']  ?></td>
			<td><?= $t['duree'] ?></td>
			<td><a href="/cities/<?= $t['ctid'] ?>/stages"><?= $t['ville'] ?></a></td>
		</tr>
	<? endforeach ?>
</tbody>
</table>
