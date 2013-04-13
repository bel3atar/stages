<table class="table table-hover table-condensed table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Etudiants</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $option): ?>
			<tr>
				<td>
					<? if ($option['etudiants']): ?>
						<a href="/options/<?= $option['id'] ?>/students">
							<?= $option['nom'] ?>
						</a>
					<? else: ?>
						<?= $option['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($option['etudiants']): ?>
						<a href="/options/<?= $option['id'] ?>/students">
							<?= $option['etudiants'] ?>
						</a>
					<? else: ?>
						<?= $option['etudiants'] ?>
					<? endif ?>
				</td>
				<td>
					<div class="btn-group">
						<a href="/options/<?= $option['id'] ?>/edit" class="btn btn-warning btn-mini">
							<i class="icon-white icon-edit"></i>
						</a>
						<? if ($option['etudiants'] == 0): ?>
							<a href="/options/<?= $option['id'] ?>/destroy" class="btn btn-danger btn-mini">
								<i class="icon-white icon-trash"></i>
							</a>
						<? endif ?>
					</div>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/options/new" class="btn btn-primary">
	<i class="icon-plus-sign icon-white"></i>
	Nouvelle
</a>
