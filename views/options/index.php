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
				<td>
					<? if ($option['etudiants']): ?>
						<a href="/options/<?= $option['id'] ?>"><?= $option['nom'] ?></a>
					<? else: ?>
						<?= $option['nom'] ?>
					<? endif ?>
				</td>
				<td><?= $option['etudiants'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/options/new" class="btn">Nouvelle</a>
