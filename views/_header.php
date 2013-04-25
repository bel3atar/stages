<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->title ?></title>
	<link rel="stylesheet" href="<?= URL ?>assets/bootstrap/css/bootstrap.min.css">
	<? if (isset($this->stylesheets)) foreach ($this->stylesheets as $s): ?>
		<link rel="stylesheet" href="<?= URL, 'assets/', $s, '.css' ?>">
	<? endforeach ?>
	<link rel="icon" href="<?= URL ?>assets/favicon.ico">
</head>
<body>
<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="">Archive de stages</a>
			<div class="nav-toolbar pull-right">
				<? if (Session::get('logged')): ?>
					<div class='btn-group'>
						<a class='btn dropdown-toggle<? if ($_SESSION['is_admin']) echo " btn-danger" ?>' data-toggle='dropdown' href='#'>
							<?= $_SESSION['nom'] ?>
							<span class='caret'></span>
						</a>
						<ul class='dropdown-menu'>
							<li>
								<a href='<?= URL ?>users/<?= $_SESSION['id'] ?>'>
									<i class='icon-user'></i>
									Profil
								</a>
							</li>
							<? if (!$_SESSION['is_admin']): ?>
								<li>
									<a href='<?= URL ?>users/<?= $_SESSION['id'] ?>/stages'>
										<i class='icon-certificate'></i>
										Stages
									</a>
								</li>
							<? endif ?>
							<li class='divider'></li>
							<li>
								<a href="<?= URL ?>sessions/destroy">
									<i class='icon-off'></i>
									Se déconnecter
								</a>
							</li>
						</ul>
					</div>

				<? else: ?>
					<a class="btn" href="<?= URL ?>sessions/new">Se connecter</a>
				<? endif ?>
			</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<ul class="nav nav-list">
				<li class="nav-header">Menu</li>
				<? if (isset($this->controller)): ?>
					<? foreach ($this->controllers as $k => $v): ?>
						<li class="<?= $k === $this->controller ? 'active' : '' ?>">
							<a href="<?= URL, $k ?>"><?= $v ?></a>
						</li>
					<? endforeach ?>
				<? else: ?>
					<? foreach ($this->controllers as $k => $v): ?>
						<li><a href="<?= URL, $k ?>"><?= $v ?></a></li>
					<? endforeach ?>
				<? endif ?>
			</ul>
		</div>
		<div class="span10">
