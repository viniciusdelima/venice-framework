<?php
VFAutoload::load('ErrorHandler', 'error');
VFAutoload::load('Factory', 'object');

/**
 * Classe factory para manipuladores de erro.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package error
 */
class ErrorHandlerFactory extends Factory {
	/**
	 * @see object.Factory::$instance
	 * @override instance
	 */
	public static $instance;
	
	/**
	 * Construtor privado da classe previne a instanciação direta da mesma.
	 *
	 * @return void
	 */
	private function __construct() {
	
	}
	
	/**
	 * Retorna uma instância
	 *
	 * @return DB
	 */
	public static function getInstance() {
		if ( !isset(self::$instance)) {
			self::$instance = new ErrorHandler();
		}
		return self::$instance;
	}
}
