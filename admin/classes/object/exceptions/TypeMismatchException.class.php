<?php
/**
 * Classe de Exceção de tipo incompatível.
 * Esta exceção será lançada toda vez que um elemento de tipo incompatível for usado em um array, coleção, parâmetro, etc.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package object
 */
class TypeMismatchException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'Tipo incompatível de dados.';
}
