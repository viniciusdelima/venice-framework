<?php
/**
 * Classe de exceção para instâncias de Sessão.
 * 
 * @author Pi Digital
 * @package util.exceptions
 */
class SessionException extends Exception {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Não foi possível iniciar a sessão.';
}
