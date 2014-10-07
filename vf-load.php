<?php
/**
 * Este script têm como objetivo carregar sistema, 
 * gerênciar as requisições as mandando para os modulos corretos e renderizar a página.
 */

/** REALIZA O AUTOLOAD DAS CLASSES UTILIZADAS NA INICIALIZAÇÃO DO SISTEMA **/
VFAutoload::load('Factory', 'object');
VFAutoload::load('DAOInterface', 'object');
VFAutoload::load('ArrayHelper', 'util');
VFAutoload::load('Validation', 'util');
VFAutoload::load('DBFactory', 'infraestructure');
VFAutoload::load('UserFactory', 'user');
VFAutoload::load('Session', 'util');
VFAutoload::load('Page', 'view');
VFAutoload::load('Validation', 'util');
VFAutoload::load('ErrorHandlerFactory', 'error');
VFAutoload::load('Collection', 'object');
VFAutoload::load('VFException', 'exception');

try {
	
	/** URL ENVIADA VIA PARÂMETRO **/
	$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	/** Sessão do usuário **/
	Session::init();

	/** Verifica se a URL requisitada pode ser roteada dentro do sistema e redireciona o usuário caso tenha algum erro **/
	Router::isRoutable($url);

	/** INSTÂNCIA UM USUÁRIO DO TIPO ADMINISTRADOR OU EDITOR **/
	$User = UserFactory::getInstance();
	global $User;

	// Manda o usuário para o módulo apropriado
	Router::dispatch($url);

	// Fim da inicialização
}

/** EXCEÇÃO DE SESSÃO **/
catch (SessionException $e) {
	echo '<h1>' . $e->getMessage() . '</h1>';
	exit();
}

/** EXCEÇÃO DE BANCO DE DADOS **/
catch (DBException $e) {
	echo '<h1>' . $e->getMessage() . '</h1>';
	exit();
}
