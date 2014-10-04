<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de Exceção para o objeto Configure.
 * Esta classe será lançada toda vez que houver um erro na manipulação de configurações internas do site.
 * 
 * @author Pi Digital
 * @package core.exceptions
 */
class ConfigureException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Erro nas configurações internas do sistema.';
}
