<legend>Liste des technologies</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Stages</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $t): ?>
			<tr>
				<td>
					<? if ($t['stages']): ?>
						<a href="/technologies/<?= $t['id'] ?>/stages">
							<?= $t['nom'] ?>
						</a>
					<? else: ?>
						<?= $t['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($t['stages']): ?>
						<a href="/technologies/<?= $t['id'] ?>/stages">
							<?= $t['stages'] ?>
						</a>
					<? else: ?>
						<?= $t['stages'] ?>
					<? endif ?>
				</td>
				<td>
					<div class="btn-group">
						<a href="/technologies/<?= $t['id'] ?>/edit" class="btn btn-warning btn-mini">
							<i class="icon-white icon-edit"></i>
						</a>
						<? if ($t['stages'] == 0): ?>
							<a href="/technologies/<?= $t['id'] ?>/destroy" class="btn btn-danger btn-mini">
								<i class="icon-white icon-trash"></i>
							</a>
						<? endif ?>
					</div>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/technologies/new" class="btn btn-primary">
	<i class="icon-plus-sign icon-white"></i>
	Nouvelle
</a>
