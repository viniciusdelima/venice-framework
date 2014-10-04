<?php
/** Interface da Classe **/
PDAutoload::load('ConfigureInterface', 'core');
PDAutoload::load('ArrayHelper', 'util');
PDAutoload::load('PDReader', 'core');
PDAutoload::load('PDWriter', 'core');
PDAutoload::load('AliasReader', 'core');
PDAutoload::load('ConfigureException', 'core.exceptions');

/**
 * Classe de configuração do sistema.
 * Esta classe têm por objetivo realizar a leitura e escrita de determinadas configurações do sistema assim como guardá-las.
 * Esta classe servirá como interface de comunicação do sistema com configurações exteriores,
 * permitindo assim que plugins cadastrem novas configurações a serem incluidas em tempo de execução no sistema.
 * 
 * Esta classe se utilizará de Readers que realizarão a leitura das configuções a serem inseridas no sistema.
 * 
 * @author Pi Digital
 * @package core
 */
class Configure implements ConfigureInterface {
	/**
	 * Readers que realizarão a leitura dos parâmetros de configuração.
	 * @name readers
	 * @access private
	 * @var array
	 */
	public static $readers = array('PDReader', 'AliasReader');
	
	/**
	 * Writers que realizarão a escrita dos parâmetros de configuração nos seus respectivos arquivos.
	 * @name writers
	 * @access private
	 * @var array
	 */
	public static $writers = array('PDWriter');
	
	/**
	 * array de configurações.
	 * @name values
	 * @access private
	 * @var array
	 */
	public static $values = array(
		'DEBUG' => array(
			'DEBUG' => 0
		)
	);
	
	/**
	 * Lê o arquivo de configurações padrão do sistema e armazena as configurações no array values
	 * 
	 * @return void
	 */
	public static function bootstrap() {
		if ( !in_array('PDReader', self::$readers)) {
			self::$readers[] = 'PDReader';
		}
		$Reader = new PDReader();
		self::write(null, $Reader->read('settings.ini'));
		self::loadAlias();
	}
	
	/**
	 * Adiciona ao array de configurações, as configurações de alias dos módulos.
	 * 
	 * @return void
	 */
	public static function loadAlias() {
		if ( !in_array('AliasReader', self::$readers)) {
			self::$readers[] = 'AliasReader';
		}
		$Reader = new AliasReader();
		self::write(null, $Reader->read('module_alias.php'));
		self::write(null, $Reader->read('module_alias.php', true));
	}
	
	/**
	 * Lê um elemento do array de configurações do sistema.
	 * 
	 * @see ConfigureInterface::read($type, $var)
	 */
	public static function read($type, $var = null) {
		if ($var == null) {
			if ( isset( self::$values[$type])) {
				return self::$values[$type];
			}
		}
		if ( isset( self::$values[$type][$var])) {
			return self::$values[$type][$var];
		}
	}
	
	/**
	 * Adiciona um elemento de configuração ao array de configurações do sistema.
	 * 
	 * @see ConfigureInterface::write($type, $config)
	 */
	public static function write($type, array $config) {
		if ( !is_array($config)) {
			return false;
		}
		if ( empty($type) && is_array($config)) {
			self::$values = ArrayHelper::insert($config, self::$values);
		}
		else if ( self::exists($type)) {
			$data[$type] = ArrayHelper::insert($config, self::$values[$type]);
			self::$values = ArrayHelper::insert($data, self::$values);
		}
		else {
			return false;
		}
		return true;
	}
	
	/**
	 * Verifica se uma determinada sessão de configuração existe no array de configurações do sistema.
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public static function exists($name) {
		if ( ArrayHelper::keyExists($name, self::$values)) {
			return true;
		}
		return false;
	}
	
	/**
	 * Atualiza o arquivo físico de configurações do sistema.
	 * 
	 * @param string $writer
	 * @return boolean
	 */
	public static function update($writer) {
		$writer = self::writerExists($writer);
		if ($writer !== false) {
			$Writer = new $writer();
			$Writer->writeSettings(self::$values);
			return true;
		}
		return false;
	}
	
	/**
	 * Verifica se o writer existe no arry de writers.
	 * 
	 * @param string $name
	 * @return string | false
	 */
	public static function writerExists($name) {
		foreach (self::$writers as $writer) {
			$Writer = new $writer();
			if ($Writer->getName() == $name) {
				unset($Writer);
				return $writer;
			}
			unset($Writer);
		}
		return false;
	}
	
}
