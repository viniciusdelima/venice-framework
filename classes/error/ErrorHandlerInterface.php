<?php
/**
 * Interface para manipulação de erros.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package error
 */
interface ErrorHandlerInterface {
	/**
	 * Seta uma mensagem de erro.
	 * 
	 * @param string $msg
	 * @return void
	 */
	public function setMessage($msg);
	
	/**
	 * Retorna uma mensagem de erro.
	 * 
	 * @return string
	 */
	public function getMessage();
	
	/**
	 * Serializa o objeto error handler e o salva na sessão.
	 * 
	 * @return void
	 */
	public function save();
}
