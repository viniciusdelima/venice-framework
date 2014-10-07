<?php
VFAutoload::load('PageInterface', 'view');
VFAutoload::load('ViewNotFoundException', 'view.exceptions');
/**
 * Classe de página.
 * Esta classe têm por objetivo representar uma página.
 * Através desta classe serão instanciadas todas as views da página do Administrador.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package view
 */
class Page implements PageInterface {
	/**
	 * DOCTYPE da página
	 * @name doctype
	 * @access private
	 * @var string
	 */
	private $doctype = '<!DOCTYPE html>';
	
	/**
	 * Cabeçalho da página
	 * @name header
	 * @access private
	 * @var string
	 */
	private $header;
	
	/**
	 * Rodapé da página
	 * @name footer
	 * @access private
	 * @var string
	 */
	private $footer;
	
	/**
	 * Sidebar da página
	 * @name sidebar
	 * @access private
	 * @var string
	 */
	private $sidebar;
	
	/**
	 * View da página.
	 * @name view
	 * @access private
	 * @var string
	 */
	private $view;
	
	/**
	 * Endereço padrão das views do módulo em execução
	 * @name path
	 * @access private
	 * @var string
	 */
	private $path;
	
	/**
	 * Endereço padrão das views da página
	 * @name pathTemplate
	 * @access private
	 * @var string
	 */
	private $pathTemplate;
	
	/**
	 * Extensão do arquivo de view da página.
	 * @name extension
	 * @access private
	 * @var string
	 */
	private $extension;
	
	/**
	 * Saída armazenada em cache.
	 * @name obCache
	 * @access private
	 * @var mixed
	 */
	private $obCache;
	
	public function __construct() {
		$this->path = Router::getModulePathView();
		$this->pathTemplate = Router::getPathView();
		$this->extension = '.php';
		if ( file_exists($this->pathTemplate . DS . 'header.php')) {
			$this->header = $this->pathTemplate . DS . 'header.php';
		}
		if ( file_exists($this->pathTemplate . DS . 'footer.php')) {
			$this->footer = $this->pathTemplate . DS . 'footer.php';
		}
		if ( file_exists($this->pathTemplate . DS . 'sidebar.php')) {
			$this->sidebar = $this->pathTemplate . DS . 'sidebar.php';
		}
	}
	
	/**
	 * Seta um cabeçalho para a página.
	 * 
	 * @see PageInterface::setHeader($header)
	 */
	public function setHeader($header) {
		$this->header = $header;
	}
	
	/**
	 * Seta um rodapé para a página.
	 * 
	 * @see PageInterface::setFooter($footer)
	 */
	public function setFooter($footer) {
		$this->footer = $footer;
	}
	
	/**
	 * Seta a sidebar de uma página.
	 * 
	 * @see PageInterface::setSidebar($sidebar)
	 */
	public function setSidebar($sidebar) {
		$this->sidebar = $sidebar;
	}
	
	/**
	 * Seta o arquivo de view da página.
	 * 
	 * @param string $view
	 * @return void
	 */
	public function setView($view) {
		$this->view = $view;
	}
	
	/**
	 * Seta o caminho para a pasta de view do sistema.
	 * 
	 * @param string $path
	 * @return void
	 */
	public function setPath($path) {
		$this->path = $path;
	}
	
	/**
	 * Seta a extensão do arquivo de view da página.
	 * 
	 * @param string $extension
	 * @return void
	 */
	public function setExtension($extension) {
		$this->extension = $extension;
	}
	
	/**
	 * Retorna o header da página
	 * 
	 * @see PageInterface::getHeader($echo)
	 */
	public function getHeader($echo = true) {
		global $User;
		if ($echo) { require $this->header; }
		return $this->header;
	}
	
	/**
	 * Retorna o rodapé da página.
	 * 
	 * @see PageInterface::getFooter($echo)
	 */
	public function getFooter($echo = true) {
		global $User;
		if ($echo) { require $this->footer; }
		return $this->footer;
	}
	
	/**
	 * Retorna o sidebar da página.
	 * 
	 * @see PageInterface::getSidebar($echo = true)
	 */
	public function getSideBar($echo = true) {
		if ($echo) include $this->sidebar;
		return $this->sidebar;
	}
	
	/**
	 * Retorna o nome da view da página.
	 * 
	 * @return string
	 */
	public function getView() {
		return $this->view;
	}
	
	/**
	 * Retorna o caminho para apasta de views da página.
	 * 
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}
	
	/**
	 * Retorna a extensão do arquivo de view da página.
	 * 
	 * @return string
	 */
	public function getExtension() {
		return $this->extension;
	}
	
	/**
	 * Retorna e exibe o conteúdo guardado em cache.
	 * 
	 * @param boolean $echo
	 * @return mixed
	 */
	public function getObCache($echo = true) {
		if ($echo)
			echo $this->obCache;
		return $this->obCache;
	}
	
	/**
	 * Renderiza a página enviando a saída html para o navegador.
	 * 
	 * @param VFAction $Module
	 * @throws ViewNotFoundException
	 * @return void
	 */
	public function render($Module) {
		global $User;
		$this->getHttpHeaders();
		$this->view = $Module->getView();
		if ( file_exists($this->path . DS . $this->view . $this->extension) ) {
			// Manipula saída e cache
			$this->obCache = ob_get_contents();
			ob_end_clean();
			
			// Exibe a saída
			$this->getHeader();
			$User->isLogged() == true && $this->view != 'login' ? $this->getSidebar() : $User;
			$this->getObCache();
			$Module->run();
			$this->getFooter();
		}
		else {
			throw new ViewNotFoundException();
		}
	}
	
	/**
	 * Emite os headers http da página para o cliente
	 * 
	 * @return void
	 */
	private function getHttpHeaders() {
		header('Content-type: text/html;charset=utf-8');
	}
	
	/**
	 * Retorna o title da página.
	 * 
	 * @return string
	 */
	public static function getTitle() {
		return Configure::read('SITE', 'SITE_NAME');
	}
}
