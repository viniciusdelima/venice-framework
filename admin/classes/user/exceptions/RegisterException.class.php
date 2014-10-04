<?php
VFAutoload::load('VFException', 'exception');

/**
 * Classe de excessão usada no cadastro de usuários no sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user/exceptions
 */
class RegisterException extends VFException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido ao cadastrar.';
}
