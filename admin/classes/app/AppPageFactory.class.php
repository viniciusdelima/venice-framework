<?php
VFAutoload::load('Factory', 'object');
VFAutoload::load('AppPage', 'app');
VFAutoload::load('AppPageDAO', 'app');
/**
 * Classe Factory para criação de páginas da visão do usuário.
 * Esta classe têm por objetivo fornecer páginas dos mais variados tipos que serão exibidas na visão do usuário (app).
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package app 
 */
class AppPageFactory extends Factory {
	
	/**
	 * Construtor da classe.
	 *
	 * @return void
	 */
	public function __construct() {
	
	}
	
	/**
	 * Retorna uma instância
	 *
	 * @see Factory::getInstance()
	 * @param string $type
	 * @return AppPage 
	 */
	public static function getInstance($type = 'AppPage') {
		/** INCLUI O ARQUIVO DA CLASSE DE PÁGINA CONFORME O TIPO DE PÁGINA A SER CRIADO **/
		if ( $type != 'AppPage' ) {
			VFAutoload::load($type, 'AppPage');
		}
		
		if ( isset(self::$instance)) {
			self::$instance = null;
		}
		
		$AppPageDAO = $type . 'DAO';
		$AppPageDAO = new $AppPageDAO();
		$pointer = &$AppPageDAO;
		$AppPage    = new $type($pointer);
		self::$instance = $AppPage;
		return self::$instance;
	}
}
