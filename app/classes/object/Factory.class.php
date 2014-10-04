<?php
/**
 * Classe padrão para classes que utilizem o padrão Factory de orientação a objeto
 * Cada módulo têm a opção de estender ou não esta classe, sendo que se extendê-la
 * terá maior facilidade na interação com sistema.
 * 
 * Esta classe têm a possibilidade de usar ou não o padrão singleton, 
 * sendo que vêm por padrão com o uso de singleton desativado.
 * 
 * @author Pi Digital
 * @package object
 */
abstract class Factory {
	/**
	 * Instância do objeto a ser instânciado
	 * @name instance
	 * @access protected
	 * @var Object
	 */
	protected static $instance;
	
	/**
	 * Construtor privado da classe previnindo a instanciação direta da classe.
	 * 
	 * @return void
	 */
	private function __construct() {
		
	}
	
	/**
	 * Previne que a instância seja clonada
	 * 
	 * @return void
	 */
	public function __clone() {
		trigger_error('Clonagem de classes não é permitida.', E_USER_ERROR);
	}
	
	/**
	 * Disconecta do banco de dados e destroi a instância atual da classe DB
	 *
	 * @return void
	 */
	public static function destroy() {
		unset(self::$instance);
	}
	
}
