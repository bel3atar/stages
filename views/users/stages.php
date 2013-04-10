<legend>Stages effectués par <?= $this->nom ?></legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Technologies</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<? foreach ($this->list as $s): ?>
				<td><a href="/entreprises/<?= $s['eid'] ?>"><?= $s['e'] ?></a></td>
				<td><?= $s['date'] ?></td>
				<td><?= $s['duree'] ?></td>
				<td>
					<? $ts   = explode(',', $s['techs']   ) ?>
					<? $tids = explode(',', $s['techids'] ) ?>
					<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
						<a href="/technologies/<?= $tids[$i] ?>">
						<?= $ts[$i] ?></a><?= $i ? ', ' : '' ?>
					<? endfor ?>
				</td>	
			<? endforeach ?>
		</tr>
	</tbody>
</table>
