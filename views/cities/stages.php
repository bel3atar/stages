<legend>Stages pour <?= $this->ville ?></legend>
<table class="table table-hover table-condensed table-striped">
	<thead>
		<tr>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Technologies</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $s): ?>
			<tr>
				<td>
					<a href="/entreprises/<?= $s['entrepriseid'] ?>/stages">
						<?= $s['entreprise'] ?>
					</a>
				</td>
				<td><?= $s['date'] ?></td>
				<td><?= $s['duree'] ?></td>
				<? $ts = explode(',', $s['tnames']) ?>
				<? $tids = explode(',', $s['tids']) ?>
				<td>
					<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
							<a href="/technologies/<?= $tids[$i] ?>/stages">
							<?= $ts[$i] ?></a><?= $i ? ', ' : null ?>
					<? endfor ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
