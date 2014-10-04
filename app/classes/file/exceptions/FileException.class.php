<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de exceção para o gerênciamento de arquivos.
 * Esta exceção é lançada sempre que ocorre um erro relativo ao gerênciamento de arquivos no sistema.
 * 
 * @author Pi Digital
 * @package file.exceptions
 */
class FileException extends PDException {
	/**
	 * Mensagem de erro padrão.
	 * 
	 * @see PDException::$errorMessage
	 */
	protected $errorMessage = 'Erro interno no sistema de arquivos.';
}
