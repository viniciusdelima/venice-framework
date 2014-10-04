<?php
PDAutoload::load('FAQElement', 'app');
PDAutoload::load('Factory', 'object');
/**
 * Classe Factory para a criação de elementos usados na FAQ (FAQElements).
 * 
 * @author Pi Digital
 * @package app
 */
class FAQElementFactory extends Factory {
	/**
	 * @see object.Factory::$instance
	 * @override instance
	 */
	public static $instance;
	
	/**
	 * Construtor público da classe.
	 *
	 * @return void
	 */
	public function __construct() {
		
	}
	
	/**
	 * Retorna uma instância
	 *
	 * @return FAQElement
	 */
	public static function getInstance() {
		$dao = new FAQElementDAO();
		$dao = &$dao;
		$FAQElement = new FAQElement($dao);
		self::$instance = &$FAQElement; 
		return self::$instance;
	}
}
