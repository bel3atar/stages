<legend>Liste des entreprises</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Personnel</th>
			<th>Agences</th>
			<th>Villes</th>
			<th>Stages</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $e): ?>
			<tr>
				<td><a href="/entreprises/<?= $e['eid'] ?>"><?= $e['nom'] ?></a></td>
				<td><?= $e['personnel'] ?></td>
				<td><?= $e['branches']  ?></td>
				<td><?= $e['villes']    ?></td>
				<td><?= $e['stages']    ?></td>
				<td>
					<div class="btn-group">
						<a href="/entreprises/<?= $e['id'] ?>/edit" class="btn btn-warning btn-mini">
							<i class="icon-white icon-edit"></i>
						</a>
						<? if ($e['stages'] == 0): ?>
							<a href="/entreprises/<?= $e['id'] ?>/destroy" class="btn btn-danger btn-mini">
								<i class="icon-white icon-trash"></i>
							</a>
						<? endif ?>
					</div>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/entreprises/new" class="btn btn-primary">
	<i class="icon-white icon-plus-sign"></i>
	Nouvelle
</a>
