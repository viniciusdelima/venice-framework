<?php
/**
 * Esta classe irá ser responsável pelo gerênciamento e manipulação de erros gerados no sistema.
 * Esta classe será responsável por guardar informações e mensagens sobre erros e exceções lançadas
 * durante a execução do sistema.
 * Esta classe será capaz também de gravar logs de erros em arquivos.
 * 
 * @author Pi Digital
 * @package error
 */
class ErrorHandler {
	/**
	 * Mensagem de erro a ser exibida.
	 * @name message
	 * @access protected
	 * @var string
	 */
	protected $message;
	
	/**
	 * Construtor da classe.
	 * 
	 * @return void
	 */
	public function __construct() {
		
	}
	
	/**
	 * Seta uma mensagem de erro.
	 * 
	 * @see ErrorHandlerInterface::setMessage($msg)
	 */
	public function setMessage($msg) {
		$this->message = $msg;
	}
	
	/**
	 * Retorna uma mensagem de erro.
	 * 
	 * @see ErrorHandlerInterface::getMessage()
	 */
	public function getMessage($msg) {
		return $this->message;
	}
	
	/**
	 * Serializa o manipulador de erro e o salva na sessão.
	 * 
	 * @see ErrorHandlerInterface::save()
	 */
	public function save() {
		$instance = $this;
		$obj = serialize($instance);
		Session::insert($obj, 'error');
	}
}
