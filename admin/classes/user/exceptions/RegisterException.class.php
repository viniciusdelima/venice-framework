<?php
PDAutoload::load('PDException', 'exception');

/**
 * Classe de excessão usada no cadastro de usuários no sistema.
 * 
 * @author Pi Digital
 * @package user/exceptions
 */
class RegisterException extends PDException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido ao cadastrar.';
}
