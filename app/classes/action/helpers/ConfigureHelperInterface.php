<?php 
/**
 * Interface padrão para o ConfigureHelper.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package action.helpers
 */
interface ConfigureHelperInterface {
	/**
	 * Retorna uma determinada configuração.
	 * 
	 * @param string $name
	 * @return string | int
	 */
	public function getConfig($name);
	
	/**
	 * Atualiza a configuração no array de configurações do sistema.
	 * 
	 * @param string $key
	 * @param string | int $value
	 * @return void
	 */
	public function setConfig($key, $value);
}
