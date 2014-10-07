<?php
/**
 * Interface para a classe de autoload padrão do sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package autoload
 */
interface VFAutoloadInterface {
	
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
