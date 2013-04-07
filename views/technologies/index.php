<legend>Liste des technologies</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Stages</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $t): ?>
			<tr>
				<td>
					<? if ($t['stages']): ?>
						<a href="/technologies/<?= $t['id'] ?>">
							<?= $t['nom'] ?>
						</a>
					<? else: ?>
						<?= $t['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<?= $t['stages'] ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/technologies/new" class="btn btn-primary">Nouvelle</a>
