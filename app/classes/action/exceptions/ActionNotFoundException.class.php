<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de Exceção para Actions.
 * Esta classe será lançada toda vez que houver erros específicos dentro de actions.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package action.exceptions
 */
class ActionNotFoundException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'A action informada não foi encontrada ou não pôde ser roteada dentro do sistema.';
}