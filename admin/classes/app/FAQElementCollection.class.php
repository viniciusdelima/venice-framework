<?php
VFAutoload::load('Collection', 'object');
VFAutoload::load('FAQElementCollectionInterface', 'app');
/**
 * Classe para o gerênciamento de uma coleção de FAQElements.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package app
 */
class FAQElementCollection extends Collection implements FAQElementCollectionInterface {
	/**
	 * Construtor da classe.
	 * 
	 * @see Collection::__construct($type)
	 */
	public function __construct() {
		parent::__construct('FAQElement');
	}
	
	/**
	 * Procura e retorna um FAQElement dentro da coleção de FAQElements.
	 * 
	 * @param int $id
	 * @throws FAQElementException
	 * @return FAQElement | false
	 */
	public function getElementById($id) {
		$iterator = $this->entries->getIterator();
		$result = false;
		$key = false;
		
		while ( $iterator->valid() ) {
			$element = $iterator->current();
			$data = $element->getData();
			if ($data['id'] == $id) {
				$key = $iterator->key();
			}
			$iterator->next();
		}
		
		if ( false === $key) {
			throw new FAQElementException('Não foi possível encontrar a pergunta selecionada.');
			return $result;
		}
		$result = $iterator->offsetGet($key);
		$result = &$result;
		return $result;
	}
}
