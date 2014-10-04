<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de Exceção para o objeto Configure.
 * Esta classe será lançada toda vez que houver um erro na manipulação de configurações internas do site.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package core.exceptions
 */
class ConfigureException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Erro nas configurações internas do sistema.';
}
