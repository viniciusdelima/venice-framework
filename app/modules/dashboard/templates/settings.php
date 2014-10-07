<div class="span7">
	<h1>Configurações Gerais</h1>
		
	<form class="formulario-horizontal" action="<?php echo HtmlHelper::createsValidURL('dashboard', 'settings'); ?>" method="post">
		<?php $this->getMessage(); ?>
		<div class="control-group">
			<label class="control-label">Nome do site:</label> 
			<div class="controls">
				<input class="span7" type="text" name="sname" value="<?php echo $config['site_name']; ?>" placeholder="Nome do site">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Email principal:</label>
			<div class="controls">
				<input class="span7" type="email" name="email" value="<?php echo $config['primary_email']; ?>" placeholder="E-mail principal">
			</div>
		</div>

		<div class="chekbox">
			<?php if ($config['activated_entries'] == 1) : ?>
				<label>Cadastros Ativados: <input type="checkbox" name="activated" checked></label>
			<?php else : ?>
				<label>Cadastros Ativados: <input type="checkbox" name="activated"></label>
			<?php endif; ?>
		</div>
		<input class="btn" style="margin-top: 20px;" type="submit" value="confirmar">
	</form>
</div>