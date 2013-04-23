<div class="page-header"><?= $this->title ?> <small> Liste des étudiants</small></div>
<table class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nom complet</th>
			<th>Né(e) le</th>
			<th>Téléphone</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $e): ?>
			<tr>
				<td><?= $e['id'] ?></td>
				<td><a href="<?= URL ?>users/<?= $e['id'] ?>/stages"><?= $e['nom'] ?></a></td>
				<td><?= $e['ne_le'] ?></td>
				<td><?= $e['tel'] ?></td>
				<td><?= $e['email'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
