<?php
/**
 * Classe de validação.
 * Esta classe servirá como utilitário de validação, usada para validar e filtrar 
 * inputs e outputs.
 * 
 * @author Pi Digital
 * @package util
 */
class Validation {
	/**
	 * Criptografa uma string.
	 * 
	 * @param string $str
	 * @return string
	 */
	public static function encript($str) {
		$encript_key = Configure::read('SECURITY KEYS', 'ENCRIPT_KEY');
		$code = sha1($encript_key . md5($str));
		return $code;
	}
	
	/**
	 * Encripta uma entrada a ser salva na session.
	 * 
	 * @param string $str.
	 * @return string
	 */
	public function encriptSession($str) {
		$encript_key = Configure::read('SECURITY KEYS', 'SESSION_KEY');
		$code = sha1($encript_key . md5($str));
		return $code;
	}
	
	/**
	 * Trata string para evitar sql_injection.
	 * 
	 * @param string $str
	 * @return string
	 */
	public static function antiInjection($str) {
		if ( !empty($str)) {
			
			// Se a string for numérica
			is_numeric($str) ? $str = (int) $str : $str;
		
			// remove espaços do início e fim da string
			$str = trim($str);
		
			// remove tags html da string
			$str = strip_tags($str);
		
			// remove barras invertidas
			$str = stripslashes($str);
		
			// Versão do php
			$versao = phpversion();
		
			$versao < 5.3 ? $str = mysql_escape_string($str) : $str = mysql_real_escape_string($str);
		
		}
		return $str;
	}
	
	/**
	 * Valida uma variável presente no array post ou get
	 * 
	 * @param string $var
	 * @param string $method
	 * @return string | int | boolean
	 */
	public static function setVar($var, $method) {
		if ( strtolower($method) == 'post') {
			if ( isset($_POST[$var])) {
				is_numeric($_POST[$var]) ? $_POST[$var] = (int)$_POST[$var] : $_POST[$var];
				$_POST[$var] = self::antiInjection($_POST[$var]);
				return $_POST[$var];
			}
			else {
				$_POST[$var] = '';
				return $_POST[$var];
			}
		}
		else if ( strtolower($method) == 'get') {
			if ( isset($_GET[$var])) {
				is_numeric($_GET[$var]) ? $_GET[$var] = (int)$_GET[$var] : $_GET[$var];
				$_GET[$var] = self::antiInjection($_GET[$var]);
				return $_GET[$var];
			}
			else {
				$_GET[$var] = '';
				return $_GET[$var];
			}
		}
	}
}
