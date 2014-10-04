<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de Exceção para Actions.
 * Esta classe será lançada toda vez que houver erros específicos dentro de actions.
 * 
 * @author Pi Digital
 * @package action.exceptions
 */
class ActionNotFoundException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'A action informada não foi encontrada ou não pôde ser roteada dentro do sistema.';
}