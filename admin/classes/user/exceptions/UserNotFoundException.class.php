<?php
PDAutoload::load('PDException', 'exception');

/**
 * Classe de excessão disparada quando um usuário não existe.
 * 
 * @author Pi Digital
 * @package user/exceptions
 */
class UserNotFoundException extends PDException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'O usuário especificado não existe.';
}
