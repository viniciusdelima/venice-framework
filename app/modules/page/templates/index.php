<div class="span9">
	<div class="hero-unit">
		<?php $this->getMessage(); ?>
		<h1>Nova Página</h1>
		<br /><br />
		<form class="form-horizontal" action="<?php echo HtmlHelper::createsValidURL('page','add'); ?>" method="post">
			<div class="control-group">
				<label class="control-label">Título: </label>
				<div class="controls">
					<input type="text" name="title" class="span4" placeholder="Digite um título" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Visibilidade:</label>
				<div class="controls">
					<select name="visible">
						<option value="0">Oculta</option>
						<option value="1">Visível</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Conteúdo: </label>
				<div class="controls">
					<textarea rows="10" cols="6" name="content" class="span8" placeholder="Conteúdo da página" required> </textarea>
				</div>
			</div>
			<p><input type="submit" value="Publicar" class="btn"></p>
		</form>
	</div>
</div>
