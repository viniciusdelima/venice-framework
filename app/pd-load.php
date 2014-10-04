<?php
/**
 * Este script têm como objetivo carregar sistema, 
 * gerênciar as requisições as mandando para os modulos corretos e renderizar a página.
 */

/** REALIZA O AUTOLOAD DAS CLASSES UTILIZADAS NA INICIALIZAÇÃO DO SISTEMA **/
PDAutoload::load('Factory', 'object');
PDAutoload::load('DAOInterface', 'object');
PDAutoload::load('ArrayHelper', 'util');
PDAutoload::load('Validation', 'util');
PDAutoload::load('DBFactory', 'infraestructure');
PDAutoload::load('UserFactory', 'user');
PDAutoload::load('Session', 'util');
PDAutoload::load('Page', 'view');
PDAutoload::load('Validation', 'util');
PDAutoload::load('ErrorHandlerFactory', 'error');
PDAutoload::load('Collection', 'object');
PDAutoload::load('PDException', 'exception');

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
