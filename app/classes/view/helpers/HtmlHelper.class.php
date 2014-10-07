<?php
VFAutoload::load('HtmlHelperInterface', 'view.helpers');

/**
 * Classe Helper para elementos HTML e tags HTML.
 * Esta classe têm por objetivo auxiliar na criação de elementos HTML que se comuniquem com o sistema de alguma forma,
 * como por exemplo através de links, urls de arquivos, etc.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package view.helpers
 */
class HtmlHelper implements HtmlHelperInterface {
	/**
	 * Cria uma tag image para a exibição de uma imagem na view.
	 * 
	 * @see HtmlHelperInterface::image($filename, $properties = array())
	 */
	public static function image($filename, $properties = array()) {
		// Array de propriedades aceitas na tag img
		$prop = array('class' => '', 'id' => '', 'width' => '', 'alt' => '', 'style' => '', 
				'title' => '', 'lang' => '', 'align' => '', 'border' => '', 'height' => '',
				'ismap' => '', 'longdesc' => '', 'usemap' => '', 'vspace' => '', 'width' => '');
		
		if ( isset($filename)) {
			$src = Router::getTemplateURL() . 'images/'. $filename;
			$tag = '<img src="' . $src . '" ';
			
			// Seta as propriedades 
			if ( count($properties) > 0) {
				$prop = array_merge($prop, $properties);
				
				foreach ($prop as $propertie => $value) {
					$tag .= '' . $propertie . '=' . '"' . $value . '" ';
				}
			}
			
			$tag .= '>';
			echo $tag;
		}
	}
	
	/**
	 * Cria um link interno para o sistema.
	 * 
	 * @see HtmlHelperInterface::link($module, $action = 'index', $text,  $properties = array(), $params = array())
	 */
	public static function link($module, $action = 'index', $text,  $properties = array(), $params = array()) {
		if ( isset($module)) {
			$url = UrlManipulation::createsValidURL($module, $action, $params);
			$link = '<a href="' . $url . '" ';
			
			// Se tiverem sido setados parâmetros
			if ( count($properties) > 0) {
				foreach ($properties as $k => $i) {
					$link .= $k . '=' . $i . ' ';
				}
			}
			$link = trim($link) . '>' . $text . '</a>';
		}
		else {
			$link = '<a href="#">Link</a>';
		}
		echo $link;
	}
	
	/**
	 * Retorna a URL para os arquivos de template padrão do sistema.
	 * 
	 * @see HtmlHelperInterface::getTemplateURL()
	 */
	public static function getTemplateURL($echo = true) {
		$url = Router::getTemplateURL();
		if ($echo) echo $url;
		return $url;
	}
	
	/**
	 * Cria uma URL válida a ser usada dentro do sistema.
	 * 
	 * @see HtmlHelperInterface::createsValidURL($module, $action = 'index', $params = array())
	 */
	public static function createsValidURL($module, $action = 'index', $params = array()) {
		return UrlManipulation::createsValidURL($module, $action, $params);
	}
}
