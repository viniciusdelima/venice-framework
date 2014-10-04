<form action="<?php HtmlHelper::createsValidURL('user', 'register'); ?>" method="post">
	<div>
		<label>Login:</label>
		<input type="text" name="login">
	</div>
	<div>
		<label>Senha:</label>
		<input type="password" name="password">
	</div>
	<div>
		<label>Nome:</label>
		<input type="text" name="name">
	</div>
	<div>
		<label>Nível:</label>
		<select name="level">
			<option value="1">Administrador</option>
			<option value="2">Editor</option>
		</select>
	</div>
	<p><input type="submit" value="Cadastrar"></p>
</form>