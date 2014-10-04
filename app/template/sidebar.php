<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<!-- Páginas -->
			<li class="nav-header">Páginas</li>
				<li class="active"><a href="<?php echo HtmlHelper::createsValidURL('page'); ?>">Adicionar Página</a></li>
				<li><a href="<?php echo HtmlHelper::createsValidURL('page', 'faq'); ?>">Perguntas Frequentes</a></li>
				<li><a href="<?php echo HtmlHelper::createsValidURL('page', 'listall'); ?>">Listar Páginas</a></li>
			
			<!-- Formulários -->
			<li class="nav-header">Formulários</li>
				<li><a href="<?php echo HtmlHelper::createsValidURL('registerform'); ?>">Form. de Cadastro</a></li>
				<li><a href="<?php echo HtmlHelper::createsValidURL('contactform'); ?>">Form. de Contato</a></li>
				
			<!-- Páginas -->
			<li class="nav-header">Configurações</li>
				<li><a href="<?php echo HtmlHelper::createsValidURL('dashboard', 'settings'); ?>">Configurações Gerais</a></li>
			
			<!-- Relatórios -->
			<li class="nav-header">Relatórios</li>
				<li><a href="#">Relatórios</a></li>
				
			<!-- Temas -->
			<li class="nav-header">Temas</li>
				<li><a href="#">Gerenciar Temas</a></li>
		</ul>
	</div>
</div>