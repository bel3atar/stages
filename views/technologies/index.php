<legend>Liste des technologies</legend>
<table class="table table-condensed table-striped">
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
					<a href="/technologies/<?= $t['id'] ?>">
						<?= $t['nom'] ?>
					</a>
				</td>
				<td>
					<?= $t['stages'] ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
