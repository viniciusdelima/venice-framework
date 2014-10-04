<?php
/**
 * Arquivo de inicialização do sistema.
 * Este arquivo será usado na inicialização do sistema e através dele serão incluidos
 * os arquivos excenciais para a iniciialização do sistema como classes de banco de dados,
 * constantes padrão entre ouras coisas.
 */

/** SEPARADOR DE DIRETÓRIOS **/
if ( !defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }
require 'includes' . DS . 'constants.inc.php';

/** CLASSE DE AUTOLOAD PADRÃO DO SISTEMA **/
require 'classes' . DS . 'autoload' . DS . 'VFAutoload.class.php';

/** CONFIGURAÇÕES GERAIS DO SISTEMA **/
VFAutoload::load('Configure', 'core');
VFAutoload::load('Router', 'routing');
Configure::bootstrap();

/** DEBUG MODE **/
if ( Configure::read('DEBUG', 'DEBUG') == (int)1) {
	ini_set('display_errors', '1');
	error_reporting(E_ALL);
}
else {
	ini_set('display_errors', '0');
	error_reporting(0);
}

/** Redireciona para uma página de erro caso necessário **/
Router::isRequestHttpError($_SERVER['REQUEST_URI']);