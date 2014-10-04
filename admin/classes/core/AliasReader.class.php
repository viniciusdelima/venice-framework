<?php
/**
 * Esta Reader será usado para ler o arquivo de alias do sistema.
 * Neste arquivo encontram-se os pseudônimos usados para a interpretação de um URL personalizada.
 * 
 * @author Pi Digital
 * @package core
 */
class AliasReader extends PDReader {
	/**
	 * Construtor da classe.
	 * Inicia a classe e chama o construtor da classe pai.
	 * 
	 * @see PDReader::__construct($path = null)
	 * @return void
	 */
	public function __construct($path = null) {
		parent::__construct($path);
	}
	
	/**
	 * Sobreescreve o método read da classe pai.
	 * 
	 * @see PDReader::read($name = 'settings.ini')
	 * @param boolean $additional
	 * @return array
	 */
	public function read($name = 'module_alias.php', $additional = false) {
		$file = $this->getPath() . DS . $name;
		if ( !is_file($file)) {
			throw new ConfigureException(5, 'Não pôde carregar o arquivo ' . $file . '.');
		}
		include $file;
		$alias = ArrayHelper::formatArrayAlias($config, $additional);
		return $alias;
	}
}
