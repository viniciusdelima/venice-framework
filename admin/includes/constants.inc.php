<?php
/**
 * Arquivo de constantes.
 * Neste arquivo ficam armazazenadas as constantes usadas na inicialização do sistema e na sua execução.
 */

/** SEPARADOR DE DIRETÓRIOS **/
if ( !defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }

/** ROTEAMENTO E URLS **/
if ( !defined('SITE_URL')) { define('SITE_URL', 'http://localhost/sistema-incentivo/'); }

/** ABSPATH **/
if ( !defined('ABSPATH')) { define('ABSPATH', dirname( dirname( dirname(__FILE__)))); }

/** ADMIN_DIR **/
if ( !defined('ADMIN_DIR')) { define('ADMIN_DIR', ABSPATH . DS . 'admin'); }

/** MUDULES_PATH **/
if ( !defined('MODULES_PATH')) { define('MODULES_PATH', ADMIN_DIR . DS . 'modules'); }
