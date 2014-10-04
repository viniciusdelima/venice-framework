<?php
PDAutoload::load('Field', 'form');
PDAutoload::load('RegisterFieldDAO', 'form');
PDAutoload::load('ContactFieldDAO', 'form');

/**
 * Classe Factory para campos.
 * Esta classe cria uma instância de um campo de formulário.
 * 
 * @author Pi Digital
 * @package form
 */
class FieldFactory extends Factory {
	/**
	 * @see object.Factory::$instance
	 * @override instance
	 */
	public static $instance;
	
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
	 * @param array $data
	 * @param string $formType
	 * @return Field
	 */
	public static function getInstance($data, $formType) {
		if ( !isset(self::$instance)) {
			
			switch ($formType) {
				case 'register' : 
					$type = 'Register';
					break;
				case 'contact' : 
					$type = 'Contact';
					break;
			}
			
			$dao = $type . 'FieldDAO';
			$dao = new $dao();
			$pointer = &$dao;
			self::$instance = new Field($pointer, $formType, $data);
		}
		return self::$instance;
	}
}
