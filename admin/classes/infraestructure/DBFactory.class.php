<?php
PDAutoload::load('DB', 'infraestructure');
PDAutoload::load('Factory', 'object');

/**
 * Classe para devolver uma instância de banco de dados.
 * Esta classe têm por objetivo ser uma Factory de instâncias da classe DB.
 * Esta classe usa os Design Patterns Factory e Singleton
 * 
 * @author Pi Digital
 * @package infraestructure
 */
class DBFactory extends Factory {
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
			self::$instance = new DB();
			
			try {
				self::$instance->configureCredentials( Configure::read('BANCO DE DADOS', 'DBHOST'), Configure::read('BANCO DE DADOS', 'DBUSER'), Configure::read('BANCO DE DADOS', 'DBPASS'), Configure::read('BANCO DE DADOS', 'DBNAME') );
				self::$instance->connect();
			}
			catch (DBException $e) {
				throw $e;
			}
		}
		return self::$instance;
	}
}
