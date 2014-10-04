<?php
/**
 * Interface padrão para classe de coleção de FAQElements.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
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
