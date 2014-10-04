<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de exceção para banco de dados.
 *
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package form.exceptions
*/

class InvalidTypeFieldException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'O tipo de formulário ao qual este campo foi adicionado é inválido.';
}