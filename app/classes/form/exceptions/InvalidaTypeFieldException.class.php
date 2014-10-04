<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de exceção para banco de dados.
 *
 * @author Pi Digital
 * @package form.exceptions
*/

class InvalidTypeFieldException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'O tipo de formulário ao qual este campo foi adicionado é inválido.';
}