<div class="span9">
	<h1>Formulário de Cadastro</h1>
	
	<?php $this->getMessage(); ?>
	
	<div class="span6 add-register-form">
		<form class="form-horizontal" style="margin-top: 20px;" action="<?php echo HtmlHelper::createsValidURL('registerform', 'add'); ?>" method="post">
			<div class="control-group">
				<label class="control-label">Nome do campo:</label>
				<div class="controls">
					<input type="text" name="name">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Tipo do campo:</label>
				<div class="controls">
					<select name="type">
						<option value="text">Texto</option>
						<option value="email">E-mail</option>
						<option value="password">Senha</option>
						<option value="state">Estado</option>
						<option value="city">Cidade</option>
						<option value="cpf">CPF</option>
						<option value="rg">RG</option>
						<option value="date">Data de Nascimento</option>
						<option value="phone">Telefone</option>
						<option value="sex">Sexo</option>
						<option value="newsletter">Newsletter</option>
						<option value="site">Site</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Descrição do campo:</label>
				<div class="controls">
					<input type="text" name="description">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Obrigatório:</label>
				<div class="controls">
					<input type="checkbox" name="mandatory">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Exibir no formulário:</label>
				<div class="controls">
					<input type="checkbox" name="active">
				</div>
			</div>
			<p><input type="submit" name="add-campo" value="Adicionar campo" class="btn"></p>
		</form>
	</div>
	
	<div class="span6 pull-right">
		<h2>Formulário Atual</h2>
		
		<?php if ( count($fields) > 0) : ?>
			<table>
				<tbody>
					<?php 
						foreach ($fields as $field) : 
						$field['field_active'] == 1 ? $visibility = 0 : $visibility = 1;
					?>
							<tr>
								<td>
									<div class="field-name"><?php echo $field['field_name']; ?></div>
									<div class="field-html"><?php echo $field['field_html']; ?></div>
								</td>
								<td><?php 
										if ($field['field_active'] == 1) { 
											HtmlHelper::link('registerform', 'update', '<i class="icon-ban-circle"></i>', null, array('id' => $field['field_id'], 'visibility' => $visibility)); 
										}
										else {
											HtmlHelper::link('registerform', 'update', '<i class="icon-ok"></i>', null, array('id' => $field['field_id'], 'visibility' => $visibility));
										}	
									?></td>
							</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<p class="lead">Você não adicionou nenhum campo ao formulário de cadastro.</p>
		<?php endif; ?>
	</div>
</div>
