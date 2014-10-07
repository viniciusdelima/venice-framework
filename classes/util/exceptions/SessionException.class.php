<?php
/**
 * Classe de exceção para instâncias de Sessão.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package util.exceptions
 */
class SessionException extends Exception {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Não foi possível iniciar a sessão.';
}
