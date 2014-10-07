<?php
/**
 * Interface para o Html Helper.
 * Esta interface fornece os métodos básicos para gerênciamento de tags HTML através do Html Helper.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package view.helpers
 */
interface HtmlHelperInterface {
	/**
	 * Cria uma tag image para uma determinada imagem no sistema.
	 * 
	 * @param string $filename
	 * @param array $properties
	 * @return void
	 */
	public static function image($filename, $properties = array());
	
	/**
	 * Cria uma tag a para um link válido no sistema.
	 * 
	 * @param string $module
	 * @param string $action
	 * @param string $text
	 * @param array $properties
	 * @param array $params
	 * @return void
	 */
	public static function link($module, $action = 'index', $text, $properties = array(), $params = array());
	
	/**
	 * Retorna a URL para os arquivos de template padrão do sistema.
	 * 
	 * @param boolean $echo
	 * @return string
	 */
	public static function getTemplateURL($echo = true);
	
	/**
	 * Cria uma URL válida a ser usada dentro do sistema.
	 * 
	 * @param string $module
	 * @param string $action
	 * @param array $params
	 * @return string
	 */
	public static function createsValidURL($module, $action = 'index', $params = array());
	
}
