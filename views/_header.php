<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->title ?></title>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="icon" href="/assets/favicon.ico">
</head>
<body>
<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="/">Archive de stages</a>
		<ul class="nav">
			<li class="pull-right"><a href="#">Se connecter</a>
		</ul>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<ul class="nav nav-list">
				<li class="nav-header">Menu</li>
				<? foreach ($this->controllers as $k => $v): ?>
					<li class="<?= $k === $this->controller ? 'active' : '' ?>">
						<a href="/<?= $k ?>"><?= $v ?></a>
					</li>
				<? endforeach ?>
			</ul>
		</div>
		<div class="span10">
