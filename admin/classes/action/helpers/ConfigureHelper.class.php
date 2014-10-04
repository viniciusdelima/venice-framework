<?php
PDAutoload::load('ConfigureHelperInterface', 'action.helpers');
/**
 * Classe helper para a alterações do arquivo de configurações do sistema.
 * Este Helper terá o objetivo de atualizar o arquivo de configurações do sistema.
 * 
 * @author Pi Digital
 * @package action.helpers
 */
class ConfigureHelper implements ConfigureHelperInterface {
	
	/**
	 * Array de configurações do sistema.
	 * @name config
	 * @access protected
	 * @var array
	 */
	protected $config = array();
	
	/**
	 * Construtor do Helper
	 */
	public function __construct() {
		$data = Configure::read('settings');
		
		foreach ($data as $j => $k) {
			$this->config[strtolower($j)] = $k;
		}
	}
	
	/**
	 * Retorna uma determinada configuração do array de configurações do sistema.
	 * 
	 * @see ConfigureHelperInterface::getConfig($name)
	 */
	public function getConfig($name) {
		if ( key_exists($name, $this->config)) {
			return $this->config[$name];
		}
	}
	
	/**
	 * Seta uma configuração no sistema.
	 * 
	 * @see ConfigureHelperInterface::setConfig($key, $value)
	 */
	public function setConfig($key, $value) {
		if ( isset($this->config[$key])) {
			$this->key = $value;
			Configure::write('', $config);
		}
	}
}
