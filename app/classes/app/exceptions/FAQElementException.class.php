<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de exceção para FAQElement.
 * 
 * @author Pi Digital
 * @package infraestrutura.exceptions
 */

class FAQElementException extends PDException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Não foi possível processar sua solicitação.';
}
