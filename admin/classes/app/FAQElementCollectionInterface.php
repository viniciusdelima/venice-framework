<?php
/**
 * Interface padrão para classe de coleção de FAQElements.
 * 
 * @author Pi Digital
 * @package app
 */
interface FAQElementCollectionInterface {
	/**
	 * Procura e retorna um FAQElement dentro da coleção.
	 * 
	 * @param int $id
	 * @return FAQElement
	 */
	public function getElementById($id);
}
