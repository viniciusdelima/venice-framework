<style type="text/css"> body { background : #f5f5f5; } </style>
<div class="container">
	<form class="form-signin" action="<?php echo HtmlHelper::createsValidURL('user', 'login'); ?>" method="post">
		<?php HtmlHelper::image('logo.png', array('class' => 'img-rounded', 'width' => '102', 'height' => '147')); ?>
		<input type="text" name="login" class="input-block-level" placeholder="Login" required>
		<input type="password" name="password" class="input-block-level" placeholder="Sua senha" required>
		<input type="submit" name="confirma" value="Logar" class="btn btn-large btn-inverse">
	</form>
</div>