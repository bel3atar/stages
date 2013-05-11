<div class='page-header'>
	<h1>Recherche <small>Résultats</small></h1>
</div>

<table class='table table-striped table-condensed table-hover'>
	<thead>
		<th>Description</th>
		<th>Ville</th>
		<th>Date</th>
		<th>Durée</th>
	</thead>
	<tbody>
		<? foreach ($this->list as $r): ?>
			<tr>
				<td>
					<a href='<?= URL, "stages/{$r['id']}" ?>'>
						<?= $r['description'] ?>
					</a>
				</td>
				<td><?= $r['nom'] ?></td>
				<td><?= $r['date'] ?></td>
				<td><?= $r['duree'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
