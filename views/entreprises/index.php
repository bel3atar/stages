<legend>Liste des entreprises</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Agences</th>
			<th>Villes</th>
			<th>Stages</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $e): ?>
			<tr>
				<td><a href="/entreprises/<?= $e['eid'] ?>"><?= $e['nom'] ?></a></td>
				<td><?= $e['branches'] ?></td>
				<td><?= $e['villes'] ?></td>
				<td><?= $e['stages'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/entreprises/new" class="btn btn-primary">
	<i class="icon-white icon-plus-sign"></i>
	Nouvelle
</a>
