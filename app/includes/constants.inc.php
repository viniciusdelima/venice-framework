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
if ( !defined('APP_DIR')) { define('APP_DIR', ABSPATH . DS . 'app'); }

/** MUDULES_PATH **/
if ( !defined('MODULES_PATH')) { define('MODULES_PATH', APP_DIR . DS . 'modules'); }

/** THEMES PATH **/
if ( !defined('THEMES_PATH')) { define('THEMES_PATH', ABSPATH . DS . 'themes'); }
