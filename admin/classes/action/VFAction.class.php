<?php
VFAutoload::load('ActionNotFoundException', 'action.exceptions');
VFAutoload::load('ModuleNotFoundException', 'action.exceptions');
VFAutoload::load('ViewNotFoundException', 'view.exceptions');
VFAutoload::load('ConfigureHelper', 'action.helpers');

/**
 * Classe de gerênciamento de actions do sistema.
 * Esta classe têm por objetivo servir de classe base as actions do módulos do sistema.
 * As actions permitem que um modo execute determinadas ações que envolvem diferentes páginas
 * ou que precisam de uma resposta do usuário, como módulos de cadastro e login por exemplo.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package action
 */
abstract class VFAction {
	
	/**
	 * Helpers usados na página.
	 * Os helpers fornecerão um interface de comunicação da view como o sistema,
	 * possibilitando o uso de formulários, criação de links internos para o sistema, etc..
	 */
	protected $helpers = array('Html');
	
	/**
	 * View de saída do módulo.
	 * @name view
	 * @access protected
	 * @var string
	 */
	protected $view;
	
	/**
	 * Variáveis disponíveis para a view.
	 * @name viewVars
	 * @access protected
	 * @var array
	 */
	protected $viewVars = array();
	
	/**
	 * Alias do do módulo, este alias poderá ser utilizado na url no lugar do nome do módulo.
	 * @name aliasOfModule
	 * @access protected
	 * @var string
	 */
	protected $aliasOfModule;
	
	/**
	 * Alias do das ações, este alias poderá ser utilizado na url no lugar do nome do módulo.
	 * @name aliasOfActions
	 * @access protected
	 * @var string
	 */
	protected $aliasOfActions = array('index' => 'home');
	
	/**
	 * Construtor da classe.
	 * Inicia a classe e instância os helpers que serão usados.
	 * 
	 * @return void
	 */
	public function __construct() {
		/** Carrega os helpers que serão usados nas views. **/
		foreach ($this->helpers as $helper) {
			VFAutoload::load($helper . 'Helper', 'view.helpers');
		}
	}
	
	/**
	 * Action principal
	 * 
	 */
	public function index() {
		
	}
	
	/**
	 * Redireciona o usuário para um módulo ou action.
	 * 
	 * @param string $module
	 * @param string $action
	 * @param array $params
	 * @throws ActionNotFound()
	 * @return void
	 */
	public function redirect($module, $action = 'index', $params = array()) {
		if ( isset($module)) {
			if ( Router::moduleExists($module)) {
				if ( $this->actionExists($module, $action)) {
					$dest = UrlManipulation::createsValidURL($module, $action, $params);
					
					// Redireciona para a url correta
					Router::redirect($dest);
				}
				
				// Action não existe
				else {
					throw new ActionNotFoundException();
				}
			}
		}
		throw new ModuleNotFoundException();
	}
	
	/**
	 * Verifica se determinada action existe dentro do módulo.
	 * 
	 * @param string $module
	 * @param string $action
	 * @return boolean
	 */
	public function actionExists($module, $action) {
		if ( isset($module) && isset($action)) {
			VFAutoload::loadModule($module);
			return method_exists($module . 'Action', $action);
		}
		return false;
	}
	
	/**
	 * Seta uma mensagem de alerta para ser salve na sessão.
	 * 
	 * @param string $msg
	 * @return void
	 */
	public function setMessage($msg) {
		Session::insert($msg, 'alert-message');
	}
	
	/**
	 * Retorna uma mensagem de alerta que esteja salva na sessão e não foi exibida ainda.
	 * 
	 * @return string
	 */
	public function getMessage() {
		if ( Session::keyExists('alert-message')) {
			$message = Session::getValue('alert-message');
			Session::remove('alert-message');
			return $message;
		}
	}
	
	/**
	 * Redireciona para uma página de erro.
	 * 
	 * @param int | string $error
	 * @return void
	 */
	public function redirectErrorPage($error) {
		Router::redirectErrorPage($error);
	}
	
	/**
	 * Método responsável por executar a saída da action atual.
	 * 
	 * @return void
	 */
	public function run() {
		if ( file_exists(Router::getModulePathView() . DS . $this->view . '.php')) {
			extract($this->viewVars);
			
			include Router::getModulePathView() . DS . $this->view . '.php';
		}
		else {
			throw new ViewNotFoundException();
		}
	}
	
	/**
	 * Seta uma variável a ser usada na view de saída da action do módulo atual.
	 * 
	 * @param string $name
	 * @param mixed $val
	 * @return void
	 */
	public function set($name, $val = null) {
		if ( is_array($name)) {
			if ( is_array($val)) {
				$data = array_combine($name, $val);
			}
			else {
				$data = $name = $val;
			}
		}
		else {
			$data = array($name => $val);	
		}
		$this->viewVars = $data + $this->viewVars;
	}
	
	/**
	 * Retorna a view atual do módulo.
	 * 
	 * @return string
	 */
	public function getView() {
		return $this->view;
	}
	
	/**
	 * Seta a view do módulo.
	 * 
	 * @param string $view
	 * @return void
	 */
	public function setView($view) {
		$this->view = $view;
	}
	
	/**
	 * Retorna um array de configurações.
	 * 
	 * @param string $name
	 * @return array
	 */
	public function getConfig($name) {
		$ConfigureHelper = new ConfigureHelper();
		$config = $ConfigureHelper->getConfig($name);
		return $config;
	}
}
