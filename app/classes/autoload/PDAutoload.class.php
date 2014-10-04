<?php
require_once 'PDAutoloadInterface.php';
/**
 * Classe de autoloading padrão do sistema.
 * 
 * @author Pi Digital
 * @package autoload
 */
class PDAutoload implements PDAutoloadInterface {
	/**
	 * Pacotes presentes no sistema.
	 * @name packages
	 * @access private
	 * @var array
	 */
	private static $packages = array(
					'exception'       => array('PDException'),
					'infraestructure' => array('DBFactory'),
					'user'            => array('Administrator', 'User'),
				);
	
	/**
	 * Classes carregadas para o sistema.
	 * @name classesLoaded
	 * @access private
	 * @var array
	 */
	private static $classesLoaded = array('PDAutoload');
	
	/**
	 * Módulos carregados para o sistema.
	 * @name modulesLoaded
	 * @access private
	 * @var array
	 */
	private static $modulesLoaded = array();
	
	/**
	 * @name path
	 * @access private
	 * @var string
	 */
	private static $path = '../';
	
	/**
	 * Indica se a classe existe no caminho especificado
	 * @name exists
	 * @access private
	 * @var boolean
	 */
	private static $exists = false;
	
	/**
	 * Pacote atual em uso
	 * @name current
	 * @access private
	 * @var string
	 */
	private static $current;
	
	/**
	 * Costrutor da classe
	 * 
	 * @return void
	 */
	public function __construct() {
		
	}
	
	/**
	 * Carrega um classe do sistema
	 * 
	 * Package pode ser um pacote único:
	 * Ex: PDAutoload::load('DBFactory', 'infraestructure');
	 * 
	 * ou um pacote composto:
	 * Ex: PDAutoload::load('DBException', 'infraestructure.exceptions');
	 * 
	 * @see PDAutoloadInterface::load($class)
	 */
	public static function load($class, $package) {
		$subpackages = explode('.', $package);
		if ( count($subpackages) > 1) {
			$package = '';
			foreach ($subpackages as $subpackage) {
				$package .= $subpackage . DIRECTORY_SEPARATOR;
			}
		}
		else {
			$package = $subpackages[0] . DIRECTORY_SEPARATOR;
		}
		
		$paths = array(
					dirname( dirname(__FILE__)) . DIRECTORY_SEPARATOR . $package . $class . '.class.php',
					dirname( dirname(__FILE__)) . DIRECTORY_SEPARATOR . $package . $class . '.php',
				);
		
		if ( file_exists($paths[0])) {
			if ( !in_array($class, self::$classesLoaded)) {
				self::$classesLoaded[] = $class;
				require $paths[0];
			}
		}
		else if ( file_exists($paths[1])) {
			if ( !in_array($class, self::$classesLoaded)) {
				self::$classesLoaded[] = $class;
				require $paths[1];
			}
			
		}
		else {
			throw new Exception('Não foi possível carregar a classe ' . $class);
		}
	}
	
	/**
	 * Carrega um módulo do sistema.
	 * 
	 * @see PDAutoloadInterface::loadModule($module)
	 */
	public static function loadModule($module) {
		$path = MODULES_PATH . DS . strtolower($module) . DS . 'actions' . DS;
		if ( file_exists($path . $module . 'Action.class.php') ) {
			if ( !in_array($module, self::$modulesLoaded)) {
				self::$modulesLoaded[] = $module;
				require $path . $module . 'Action.class.php';
			}
		}
		else if ( file_exists($path . $module . 'Action.php') ) {
			if ( !in_array($module, self::$modulesLoaded)) {
				self::$modulesLoaded[] = $module;
				require $path . $module . 'Action.php';
			}
			
		}
		else {
			throw new PDException(0, 'Não foi possível carregar a classe.');
		}
	}
}
