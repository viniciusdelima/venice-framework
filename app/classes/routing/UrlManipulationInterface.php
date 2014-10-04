<?php
/**
 * Interface de métodos úteis na manipulação de urls dentro do sistema.
 * 
 * @author Pi Digital
 * @package routing
 */
interface UrlManipulationInterface {
	/**
	 * Verifica uma URL e retorna um array contendo o módulo, action e parâmetros contidos nesta URL.
	 * 
	 * @param string $url
	 * @return boolean
	 */
	public static function parseURL($url);
	
	/**
	 * Cria uma URL e válida para ser roteada dentro do sistema.
	 * 
	 * @param string $module
	 * @param string $action
	 * @param array $params
	 * @return string
	 */
	public static function createsValidURL($module, $action = 'index', $params = array());
	
	/**
	 * Retorna uma URL para os arquivos de template padrão armazenados no diretório template.
	 * 
	 * @param string $name
	 * @return string
	 */
	public static function getValidURLForTemplateFile($name);
	
	/**
	 * Valida se a requisição foi feita para uma página ou para algum arquivo complementar como css ou js por exemplo.
	 * 
	 * @param string $url
	 * @return boolean
	 */
	public static function isRequestForSupplementaryFile($url);
}
