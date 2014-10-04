<?php
/**
 * Classe de Sessão do sistema.
 * Esta classe têm por objetivo gerênciar as sessões dos usuários no sistema.
 * Cada sessão é armazenada no array global do php $_SESSION.
 * Toda sessão têm um tempo de expiração pré-determinado.
 * 
 * @author Pi Digital
 * @package utils
 */
class Session {
	
	/**
	 * Construtor da classe
	 * 
	 * @return void
	 */
	private function __construct() {
		$this->init();
	}
	
	/**
	 * Inicia a sessão
	 * 
	 * @return void
	 */
	public static function init() {
		if ( !headers_sent()) {
			session_start();
		}
	}
	
	/**
	 * Encerra a sessão
	 * 
	 * @return void
	 */
	public static function destroy() {
		if ( !headers_sent()) {
			session_destroy();
		}
	}
	
	/**
	 * Seta uma entrada no array $_SESSION
	 * 
	 * @param array | string | int $data
	 * @param string $key
	 * @return void
	 */
	public static function insert($data, $key) {
		if ( isset($_SESSION)) {
			isset($key) ? $_SESSION[$key] = $data : $_SESSION[] = $data;
		}
	}
	
	/**
	 * Retorna um valor do array $_SESSION
	 * 
	 * @param string | int $index
	 * @return int | string | boolean | object
	 */
	public static function getValue($index) {
		if ( isset($_SESSION[$index])) {
			return $_SESSION[$index];
		}
		return false;
	}
	
	/**
	 * Verifica se determinada chave existe no array $_SESSION
	 * 
	 * @param string | int $key
	 * @return boolean
	 */
	public static function keyExists($key) {
		return isset($_SESSION[$key]);
	}
	
	/**
	 * Remove um valor da $_SESSION
	 * 
	 * @param int | string $key
	 * @return void
	 */
	public static function remove($key) {
		if ( isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}
}
