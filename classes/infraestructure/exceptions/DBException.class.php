<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de exceção para banco de dados.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package infraestrutura.exceptions
 */

class DBException extends VFException {
	/**
	 * Mensagem de erro padrão
	 * 
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido na conexão com o banco de dados.';
}
