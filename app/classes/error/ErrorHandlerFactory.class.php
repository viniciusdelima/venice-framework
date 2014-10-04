<?php
PDAutoload::load('ErrorHandler', 'error');
PDAutoload::load('Factory', 'object');

/**
 * Classe factory para manipuladores de erro.
 * 
 * @author Pi Digital
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
