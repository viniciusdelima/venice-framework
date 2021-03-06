<?php
VFAutoload::load('Factory', 'object');
VFAutoload::load('Session', 'util');

/**
 * Classe factory que fornece uma instância de uma sessão.
 * Esta classe usa o padrão Singleton para que não haja múltiplas instâncias de uma mesma sessão.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package util
 */
class SessionFactory extends Factory {
	/**
	 * Construtor privado da classe
	 * 
	 * @return void
	 */
	private function __construct() {
		
	}
	
	/**
	 * Retorna uma instância de sessão
	 * 
	 * @return Usuario
	 */
	public static function getInstance() {
		if ( !isset(self::$instance)) {
			self::$instance = new Session();
		}
		return self::$instance;
	}
}
