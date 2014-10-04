<?php
VFAutoload::load('VFException', 'exception');

/**
 * Classe de excessão disparada quando um usuário não existe.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user/exceptions
 */
class UserNotFoundException extends VFException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'O usuário especificado não existe.';
}
