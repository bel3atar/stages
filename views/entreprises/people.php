<legend>Responsables de <?= $this->entreprise ?></legend>
<table class="table table-hover table-condensed table-striped">
	<thead>
		<tr>
			<th>Nom complet</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->people as $p): ?>
			<tr>
				<td><?= $p['nom'] ?></td>
				<td><?= $p['email'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
