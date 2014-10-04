<?php
/**
 * Classe de Exceção de tipo incompatível.
 * Esta exceção será lançada toda vez que um elemento de tipo incompatível for usado em um array, coleção, parâmetro, etc.
 * 
 * @author Pi Digital
 * @package object
 */
class TypeMismatchException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'Tipo incompatível de dados.';
}
