<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de Exceção para módulos.
 * Esta classe será lançada toda vez que um módulo requisitado não existir no sistema ou não puder ser roteado.
 * 
 * @author Pi Digital
 * @package action.exceptions
 */
class ModuleNotFoundException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'O módulo requisitado não existe no sistema.';
}