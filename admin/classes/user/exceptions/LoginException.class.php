<?php
PDAutoload::load('PDException', 'exception');

/**
 * Esta classe manipulará erros referentes ao login de usuários no sistema.
 * 
 * @author Pi Digital
 * @package user.exceptions
 */
class LoginException extends PDException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido ao logar no sistema.';
}
