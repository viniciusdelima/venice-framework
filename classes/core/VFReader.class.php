<?php

/**
 * Classe Reader Padrão VFReader.
 * Esta classe têm por objetivo ler o arquivo de configurações padrão do sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package core
 */
class VFReader {
	/**
	 * Caminho para o arquivo de configurações.
	 * @name path
	 * @access protected
	 * @var string
	 */
	protected $path;
	
	public function __construct($path = null) {
		if (!$path) {
			$path = ADMIN_DIR . DS . 'includes' . DS . 'config';
		}
		$this->path = $path;
	}
	
	/**
	 * Lê um arquivo de configuração e retorna seu conteúdo.
	 * 
	 * @see ConfigureInterfaceReader::read($name = 'settings.ini')
	 * @throws ConfigureException
	 */
	public function read($name = 'settings.ini') {
		$file = $this->getPath() . DS . $name;
		if ( !is_file($file)) {
			throw new ConfigureException(5, 'Não pôde carregar o arquivo ' . $file . '.');
		}
		$config = parse_ini_file($file, true);
		return $config;
	}
	
	/**
	 * Retorna o caminho completo para um determinado arquivo de configuração.
	 * 
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}
}
