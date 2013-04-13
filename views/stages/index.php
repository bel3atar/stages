<legend>Derniers stages</legend>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>Etudiant</th>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Ville</th>
			<th>Technologies</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $stage): ?>
			<tr>
				<td>
					<a href="/users/<?= $stage['uid'] ?>/stages">
						<?= $stage['nom'] ?>
					</a>
				</td>
				<td>
					<a href="/entreprises/<?= $stage['eid'] ?>/stages">
						<?= $stage['entreprise'] ?>
					</a>
				</td>
				<td><?= $stage['date'] ?></td>
				<td><?= $stage['duree'] ?></td>
				<td>
					<a href="/cities/<?= $stage['idville'] ?>/stages">
						<?= $stage['ville'] ?>
					</a>
				</td>
				<td>
					<? $ts = explode(',', $stage['techs']) ?>
					<? $tids = explode(',', $stage['techids']) ?>
					<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
						<a href="/technologies/<?= $tids[$i] ?>/stages">
						<?= $ts[$i] ?></a><?= $i ? ', ' : null ?>
					<? endfor ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/stages/new" class="btn btn-primary">
	<i class="icon-plus-sign icon-white"></i>
	Nouveau
</a>
