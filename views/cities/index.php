<table class="table table-hover table-striped table-condensed">
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
				<td>
					<? if ($ville['stages']): ?>
						<a href="/cities/<?= $ville['id'] ?>/stages"><?= $ville['nom'] ?></a>
					<? else: ?>
						<?= $ville['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($ville['stages']): ?>
						<a href="/cities/<?= $ville['id'] ?>/stages"><?= $ville['stages'] ?></a>
					<? else: ?>
						<?= $ville['stages'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($ville['entreprises']): ?>
						<a href="/cities/<?= $ville['id'] ?>/entreprises">
							<?= $ville['entreprises'] ?>
						</a>
					<? else: ?>
						<?= $ville['entreprises'] ?>
					<? endif ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/cities/new" class="btn">Nouvelle</a>
