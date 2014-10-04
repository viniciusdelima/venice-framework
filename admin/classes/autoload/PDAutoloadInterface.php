<?php
/**
 * Interface para a classe de autoload padrão do sistema.
 * 
 * @author Pi Digital
 * @package autoload
 */
interface PDAutoloadInterface {
	
	/**
	 * Carrega um classe
	 * 
	 * @param string $class
	 * @param string $package
	 * @return void
	 */
	public static function load($class, $package);
	
	/**
	 * Carrega um módulo do sistema.
	 * 
	 * @param string $module
	 * @return void
	 */
	public static function loadModule($module);
}
