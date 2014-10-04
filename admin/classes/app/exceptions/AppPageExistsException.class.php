<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de exceção para banco de dados.
 *
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package form.exceptions
*/

class AppPageExistsException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Esta página já está cadastrada no banco de dados.';
}