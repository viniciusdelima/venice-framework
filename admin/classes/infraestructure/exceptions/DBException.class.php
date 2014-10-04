<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de exceção para banco de dados.
 * 
 * @author Pi Digital
 * @package infraestrutura.exceptions
 */

class DBException extends PDException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido na conexão com o banco de dados.';
}
