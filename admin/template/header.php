<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema Pi Digital</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php HtmlHelper::getTemplateURL(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php HtmlHelper::getTemplateURL(); ?>css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="<?php HtmlHelper::getTemplateURL(); ?>css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php HtmlHelper::getTemplateURL(); ?>js/bootstrap.min.js"> </script>
	<script src="<?php HtmlHelper::getTemplateURL(); ?>/js/placeholders.jquery.min.js"> </script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="brand" href="<?php echo HtmlHelper::createsValidURL('dashboard'); ?>">Sistema Pi Digital</a>
			<div class="nav-collapse collapse">
				<?php if ( $User->isLogged()) : ?>
					<p class="navbar-text pull-right">
						Bem vindo <span style="color: #FFFFFF;"><?php echo $User->getName(); ?></span> <?php HtmlHelper::link('user', 'logout', '(Sair)'); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">