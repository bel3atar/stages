<div class='page-header'><h1><?= $this->entreprise ?> <small>Liste des responsables</small></h1></div>
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
<? $this->render_('pager') ?>
