<?php
/**
 * Interface para a classe Configure.
 * Esta interface prevê os métodos padrão para a classe Configure.
 * 
 * @author Pi Digital
 * @package core
 */
interface ConfigureInterface {
	/**
	 * Lê uma configuração do sistema.
	 * 
	 * @param string $type
	 * @param string $var
	 * @return mixed
	 */
	public static function read($type, $var);
	
	/**
	 * Adiciona um parâmetro de configuração ao array de configurações
	 * 
	 * @param string $type
	 * @param array $config
	 * @return boolean
	 */
	public static function write($type, array $config);
	
}
