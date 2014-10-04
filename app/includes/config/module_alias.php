<?php
/**
 * Este arquivo têm por objetivo aramazenar as configurações sobre os alias dos módulos.
 * Os alias são nomes pseudônimos adicionais que podem ser usados em conjunto com um Módulo para
 * que a URL possa ser personalizada sem a necessidade de levar o nome do módulo e action em uso.
 * Para exemplificação com o uso de um alias para o módulo user, a URL que antes atendia pelo endereço:
 * http://www.pidigital.com.br/admin/user/login
 * Pode atender pelo endereço: 
 * http://www.pidigital.com.br/admin/usuario/logar
 * caso os alias logar e usuario tenham sido definidos para o módulo user.
 */

$config = array(
		'usuario' => array(
				'user', array(
					'home' => 'index',
					'login' => 'login',
					'sair' => 'logout'		
				)		
			),
		'painel' => array(
				'dashboard', array(
					'home'     => 'index',	
					'cadastro' => 'register'	
				)	
			),
		'formulario-cadastro' => array(
				'registerform', array(
						'home'     => 'index',
						'atualiza' => 'update'
				)
			),
		'formulario-contato' => array(
				'contactform', array(
						'home'     => 'index',
						'atualiza' => 'update'
				)
			),
		'pagina' => array(
			'page', array(
					'home'     => 'index',
					'adiciona' => 'add',
					'listar'   => 'listall'
				)
			)
		);
