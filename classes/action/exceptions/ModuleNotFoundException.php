<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de Exceção para módulos.
 * Esta classe será lançada toda vez que um módulo requisitado não existir no sistema ou não puder ser roteado.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package action.exceptions
 */
class ModuleNotFoundException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'O módulo requisitado não existe no sistema.';
}