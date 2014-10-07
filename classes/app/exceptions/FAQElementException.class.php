<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de exceção para FAQElement.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package infraestrutura.exceptions
 */

class FAQElementException extends VFException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Não foi possível processar sua solicitação.';
}
