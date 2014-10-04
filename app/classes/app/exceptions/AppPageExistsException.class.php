<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de exceção para banco de dados.
 *
 * @author Pi Digital
 * @package form.exceptions
*/

class AppPageExistsException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Esta página já está cadastrada no banco de dados.';
}