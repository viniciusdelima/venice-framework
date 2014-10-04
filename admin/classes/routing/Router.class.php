<?php
if ( !defined('DS')) { define('DS', DIRECTORY_SEPARATOR); };
if ( !defined('ABSPATH')) { define('ADMIN_DIR', dirname( dirname( dirname(__FILE__)))); }
PDAutoload::load('UrlManipulation', 'routing');
PDAutoload::loadModule('Basis');
PDAutoload::load('PDRequest', 'network');

/**
 * Esta classe têm por objetivo fazer o roteamento através de URLS e diretórios do sistema.
 * 
 * @author Pi Digital
 * @package route
 */
class Router {
	
	/**
	 * Guarda a URL raiz do site
	 * @name rootURL
	 * @access private
	 * @var string
	 */
	private $rootURL;
	
	/**
	 * Erros HTTP
	 * @name httpErrors
	 * @access private
	 * @var array
	 */
	private static $errors = array(403, 404, 503);
	
	/**
	 * Modulo em execução no momento.
	 * @name moduleName
	 * @access private
	 * @var string
	 */
	private static $moduleName;
	
	/**
	 * Redireciona para uma determinada página
	 * 
	 * @param $dest
	 * @param boolean $exit
	 * @return void
	 */
	public static function redirect($dest, $exit = TRUE) {
		// Verifica se os headers foram enviados
		if ( !headers_sent()) {
			header('Location: ' . $dest);
		}
		else {
			?><script> window.location = '<?php echo $dest; ?>'</script><?php
		}
		if ($exit)
			exit();
	}
	
	/**
	 * Verifica se uma determinada URL existe e pode ser roteada dentro do sistema.
	 * 
	 * @param string $url
	 * @return boolean
	 */
	public static function isRoutable($url) {
		/** Verifica se uma URL pode ser roteável dentro do sistema, caso negativo redireciona para uma página de erro 404 **/
		$route = UrlManipulation::parseURL($url);   // Dados a serem checados (módulo, action e parâmetros)
		$moduleClass = $route['module'] . 'Action';
		
		/**
		 * Tentamos carregar o módulo e caso alguma coisa dê errado, tratamos a excessão redirecionando o usuário
		 * para uma página de erro 404.
		 */
		try {
			PDAutoload::loadModule($route['module']);
		}
		catch (Exception $e) {
			self::redirectErrorPage(404);
		}
		// Action não existe no sistema
		if ( !method_exists(new $moduleClass(), $route['action'])) {
			self::redirectErrorPage(404);
		}
		// Módulo e Action existem
		else {
			return true;
		}
	}
	
	/**
	 * Retorna o caminho para a pasta de view do sistema.
	 * 
	 * @return string
	 */
	public static function getPathView() {
		defined('ADMIN_DIR') ? $path = ADMIN_DIR . DS . 'template' : $path = dirname( dirname( dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'template';
		return $path; 
	}
	
	/**
	 * Retorna o caminho para a pasta como os templates do modulo atual.
	 * 
	 * @return string
	 */
	public static function getModulePathView() {
		return MODULES_PATH . DS . self::$moduleName . DS . 'templates';
	}
	
	/**
	 * Redireciona o usuário para uma página de erro.
	 * 
	 * @return void
	 */
	public static function redirectErrorPage($error) {
		ob_clean();  // Limpa o buffer de saída
		switch ($error) {
			case 403 : 
				header('HTTP/1.0 403 Forbidden');
				$page = Configure::read('SITE', 'SITE_URL') . 'template/403.php';
				break;
			case 404 : 
				header('HTTP/1.0 404 Not Found');
				$page = Configure::read('SITE', 'SITE_URL') . 'template/404.php';
				break;
			case 503 :
				header('HTTP/1.0 503 Service Unavailable');
				$page = Configure::read('SITE', 'SITE_URL') . 'template/503.php';
				break;
		}
		self::redirect($page);
	}
	
	/**
	 * Processa uma requisição enviando para o módulo correto.
	 * 
	 * @param string $url
	 * @return void
	 */
	public static function dispatch($url) {
		global $User;
		
		/** Instância uma página para ser exibida **/
		$Page = new Page();
		
		if ( self::isRoutable($url) ) {
			/** Se a URL puder ser roteada, instanciamos e executamos o módulo apropriado **/
			// try {
				$route = UrlManipulation::parseURL($url);
				
				$module = $route['module'] . 'Action';   // Módulo
				$module = new $module();                 // Instância o Módulo
				self::$moduleName = $route['module'];    // Seta o nome do modulo atual no dispatcher
				
				// Constrói a Página
				$Page->setPath(MODULES_PATH . DS . self::$moduleName . DS . 'templates');
				$module->setView($route['action']);
				
				/**
				 * Antes de executarmos a action, verificamos se existe algum método a ser executado antes dela,
				 * ou após dela.
				 */
				if ( count($route['params']) > 0) {
					$module->beforeRunning( array($route['module'], $route['action']));
					$module->$route['action']($route['params']);
				}
				else {
					$module->beforeRunning( array($route['module'], $route['action']));
					$module->$route['action']();
				}
				
				// Renderiza a Página
				$Page->render($module);
				return ;
			// }
			/** catch ( Exception $e) {
				throw new PDException(0, 'Erro desconhecido ao processar a requisição.');
			} **/
		}
		self::redirectErrorPage($error);
	}
	
	/**
	 * Verifica se a requisição se refere a algum erro http.
	 * 
	 * @param $url
	 * @return void
	 */
	public static function isRequestHttpError($url) {
		$items = explode('?', $url);
		$items = explode('/', $items[0]);
		$error = str_replace('.php', '', $items[ count($items) - 1]);
		if ( in_array($error, self::$errors)) {
			header('Content-type: text/html;charset=utf-8');
			require dirname( dirname( dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $error . '.php';
			exit();
		}
	}
	
	/**
	 * Verifica se um determinado módulo existe no sistema.
	 * 
	 * @param string $module
	 * @return boolean
	 */
	public static function moduleExists($module) {
		return file_exists(MODULES_PATH . DS . $module);
	}
	
	
	/**
	 * Retorna a URL para o diretório de templates do sistema.
	 * 
	 * @return string
	 */
	public static function getTemplateURL() {
		$url = Configure::read('SITE', 'SITE_URL');
		return $url . 'template/';
	}
}
