<?php
/**
 * Classe padrão de excessão.
 * Todas classes de exception deverão herdar a PDException
 * 
 * @author Pi Digital
 * @package exception
 */
class PDException extends Exception {
	
	/**
	 * Mensagem de erro padrão.
	 * @name errorMessage
	 * @access private
	 * @var string
	 */
	protected $errorMessage = 'Ocorreu um erro desconhecido.';
	
	/**
	 * Construtor da classe.
	 *
	 * @param string $message
	 * @param int $code
	 * @return void
	 */
	public function __construct($message = NULL, $code = 0) {
		!isset($message[1]) ? $message = $this->errorMessage : $message = (string) $message;
		parent::__construct($message, (int)$code);
	}
	
	/**
	 * Retorna uma mensagem de erro
	 *
	 * @return string
	 */
	public function getErrorMessage() {
		if ( isset($this->message[1])) {
			return $this->message;
		}
		return $this->errorMessage;
	}
}
