<?php
VFAutoload::load('VFException', 'exception');

/**
 * Esta classe manipulará erros referentes ao login de usuários no sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user.exceptions
 */
class LoginException extends VFException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido ao logar no sistema.';
}
