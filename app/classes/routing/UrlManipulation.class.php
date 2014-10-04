<?php
PDAutoload::load('UrlManipulationInterface', 'routing');

/**
 * Classe para manipulação de URL's.
 * Esta classe será usada pela classe routing na manipulação de URLS.
 * 
 * @author Pi Digital
 * @package routing
 */
class UrlManipulation implements UrlManipulationInterface {
	/**
	 * Verifica uma URL e retorna um array contendo módulo, action e parâmetros da URL.
	 * 
	 * @see UrlManipulationInterface::parseURL($url, $friendly = false)
	 */
	public static function parseURL($url) {
		$friendly = Configure::read('SITE', 'FRIENDLY_URL');
		/** Se for uma URL amigável **/
		if ( $friendly ) {
			$main_url = Configure::read('SITE', 'SITE_URL');
			$parts = explode($main_url, $url);
			$parts = explode('/', $parts[1]);
			$parts = ArrayHelper::clean($parts);
			isset($parts[0]) ? $module = $parts[0] : $module = '';
			isset($parts[1]) ? $action = $parts[1] : $action = 'index';
			$params = null;
			count($params > 2) ? $params = array_slice($parts, 2) : $params = null;
			
			/**
			 * Se a chamada for para a index,
			 * Setamos o módulo e action definidos nas configurações default do sistema.
			 **/
			if ($module == 'index' || empty($module)) {
				$module = Configure::read('ROUTING', 'MODULE');
				$action = Configure::read('ROUTING', 'ACTION');
				!empty($action) ? $action = Configure::read('ROUTING', 'ACTION') : $action = 'index';
			}
			$data = array('module' => $module, 'action' => $action, 'params' => $params);
		}
		else {
			$params = explode('?', $url);
			$parts = explode('/', $params[0]);
			$module = str_replace('.php', '', $parts[ count($parts) - 1]);
			
			/** Extrai a action da URL **/
			if ( count($params) > 1) {
				$actions = explode('a=', $params[1]);
				// Remove índices vazios
				$actions = ArrayHelper::clean($actions);
				if( count($actions) > 0 ) {
					$action_params = explode('&', $actions[0]);
					$action = $action_params[0];
					$params = null;
					if ( count($action_params) > 1) {
						unset($action_params[0]);
						$params = $action_params;
					} 
				}
				if ( count($actions) > 1 ) {
					$params = explode('&', $actions[1]);
					$params = ArrayHelper::clean($params);
				}
			}
			else {
				$action = 'index';
			}
			
			/**
              * Se a chamada for para a index,
              * Setamos o módulo e action definidos nas configurações default do sistema. 
			**/
			if ($module == 'index' || empty($module)) {
				$module = Configure::read('ROUTING', 'MODULE');
				$action = Configure::read('ROUTING', 'ACTION');
				!empty($action) ? $action = Configure::read('ROUTING', 'ACTION') : $action = 'index';
			}
			
			$data = array('module' => $module, 'action' => $action, 'params' => $params);
		}
		$data = self::translate($data);
		return $data;
	}
	
	/**
	 * Cria uma URL e válida para ser roteada dentro do sistema.
	 * 
	 * @see UrlManipulationInterface::createsValid($module, $action = 'index', $params = array())
	 */
	public static function createsValidURL($module, $action = 'index', $params = array()) {
		$friendly = Configure::read('SITE', 'FRIENDLY_URL');  // URL Amigável
		$params = ArrayHelper::clean($params);                // Limpa array de entradas vazias
		
		$data = self::translate( array('module' => $module, 'action' => $action, $params));
		$module = $data['module'];
		$action = $data['action'];
		
		/** URL Padrão **/
		if ( $friendly == false ) {
			$url = Configure::read('SITE', 'SITE_URL') . $module . '.php?a=' . $action;
			
			if ( is_array($params) && count($params) > 0) {
				foreach ($params as $k => $i) {
					$url .= '&' . $k . '=' . $i;
				}
			}
			return $url;
		}
		
		/** URL Amigável **/
		else {
			$url = Configure::read('SITE', 'SITE_URL') . $module . '/' . $action . '/';
			
			if ( is_array($params) && count($params) > 0) {
				foreach ($params as $param) {
					$url .= $param . '/';
				}
			}
			return $url;
		}
	}
	
	/**
	 * Retorna um URL para os arquivos de template padrão armazenados no diretório template.
	 * 
	 * @see UrlManipulation::getValidURLForTemplateFile($name)
	 */
	public static function getValidURLForTemplateFile($name) {
		if ( self::isRequestForSupplementaryFile($name)) {
			$parts = explode('/', $url);
			$file = $parts[ count($parts) - 1];
		}
		$url = Configure::read('SITE', 'SITE_URL') . 'template/' . $name;
		return $url;
	}
	
	/**
	 * Valida se a requisição foi feita para uma página ou para algum arquivo complementar como css e js por exemplo.
	 * 
	 * @see UrlManipulationInterface::isRequestForSupplementaryFile($url, $friendly = false)
	 */
	public static function isRequestForSupplementaryFile($url, $friendly = false) {
		$friendly = Configure::read('SITE', 'FRIENDLY_URL');
		if ($friendly) {
			
		}
		else {
			$parts = explode('/', $url);
			$file = $parts[ count($parts) - 1];
			$pattern = '/^[a-zA-Z0-9-_\.]+\.(png|js|csv|jpg|jpeg|gif|xml|css|json|otf|svg|woff|ttf)$/';
			
			if ( preg_match($pattern, $file)) {
				return true;
			}
			return false;
		}
	}
	
	/**
	 * Retorna o nome de um arquivo solicitado em uma URL.
	 * 
	 * @see UrlManipulationInterface::getRequestFileName($url, $friendly = false)
	 */
	public static function getRequestFileName($url, $friendly = false) {
		$friendly = Configure::read('SITE', 'FRIENDLY_URL');
		if ($friendly) {
			
		}
		else {
			$parts = explode('/', $url);
			$file = $parts[ count($parts) - 1];
			return $file;
		}
	}
	
	/**
	 * Retorna o mime type de um arquivo solicitado na URL.
	 * 
	 * @see UrlManipulation::getMimeTypeFromRequestedFile($filename)
	 */
	public static function getMimeTypeFromRequestedFile($filename) {
		$parts = explode('.', $filename);
		$mimeType = $parts[ count($parts) - 1];
		switch ($mimeType) {
			case 'png' : $mimeType = 'image/png';
				break;
			case 'jpg' : $mimeType = 'image/jpeg';
				break; 
			case 'gif' : $mimeType = 'image/gif';
				break;
			case 'html' : $mimeType = 'text/html';
				break;
			case 'htm' : $mimeType = 'text/htm';
				break;
			case 'css' : $mimeType = 'text/css';
				break;
			case 'js' : $mimeType = 'application/x-javascript';
				break;
			case 'csv' : $mimeType = 'text/csv';
				break;
			case 'xml' : $mimeType = 'application/xml';
				break;
			case 'json' : $mimeType = 'application/json';
				break;
		}
		return $mimeType;
	}
	
	/**
	 * Traduz uma url personalizada.
	 * O objetivo deste método é fazer com que o sistema seja capaz de traduzir os nomes
	 * dos plugins e actions para português.
	 * Graças a isto a URL digitada pelo usuário não necessariamente correspondera aos
	 * nomes dos arquivos reais utilizados no sistema, assim como a URL seja mais legível perante os usuários.
	 *
	 * @param array $data
	 * @return array
	 */
	public static function translate(array $data) {
		$module = $data['module'];
		$action = $data['action'];
		$alias = Configure::read($module);
		if ( count($alias) > 0 && isset($alias['routing'])) {
			if ($alias['routing'] == true) {
				$data['module'] = $alias['module'];
				if ( isset($alias[$action])) {
					$data['action'] = $alias[$action];
				}
			}
		}
		return $data;
	}
}
