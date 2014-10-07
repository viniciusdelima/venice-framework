<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de exceção para o gerênciamento de arquivos.
 * Esta exceção é lançada sempre que ocorre um erro relativo ao gerênciamento de arquivos no sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package file.exceptions
 */
class FileException extends VFException {
	/**
	 * Mensagem de erro padrão.
	 * 
	 * @see VFException::$errorMessage
	 */
	protected $errorMessage = 'Erro interno no sistema de arquivos.';
}
