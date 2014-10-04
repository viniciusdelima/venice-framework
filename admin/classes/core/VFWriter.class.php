<?php
VFAutoload::load('VFReader', 'core');
VFAutoload::load('File', 'file');
/**
 * Classe para escrita no arquivo de configurações padrão do sistema.
 * Esta classe escreverá as configurações do array de configurações padrão do sistema
 * para um arquivo "físico" se utilizando da classe File do sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package core
 */
class VFWriter extends File {
	
	/**
	 * Nome do Writer
	 * @name name
	 * @access private
	 * @var string
	 */
	private $name = 'pd';
	
	/**
	 * Construtor da classe.
	 * 
	 * @return void
	 */
	public function __construct() {
		$path = ADMIN_DIR . DS . 'includes' . DS . 'config' . DS . 'settings.ini';
		parent::__construct($path);
	}
	
	/**
	 * Escreve as novas configurações no arquivo de configurações do sistema.
	 *
	 * @see ConfigureInterfaceWriter::read($name = 'settings.ini')
	 * @throws ConfigureException
	 */
	public function writeSettings($data, $name = 'settings.ini') {
		ini_set('auto_detect_line_endings', 1);
		// Formata o array de dados para que este possa ser gravado em disco
		$new = $this->parse($data);
		$Reader = new VFReader();
		$old = $this->parse( $Reader->read());
		
		$data = '';
		
		$this->open('r');
		
		while( !feof($this->handle) ) {
			$line = fgets($this->handle, 4096);
			foreach ($old as $j => $k) {
				$k = preg_replace('/\//', '\/', $k);
				$pattern = '/' . $j . ' = (' . $k . '|\"' . $k . '\")/';
				$replace = $j . ' = ' . $new[$j];
				$line = preg_replace($pattern, $replace, $line);
			}
			$data .= $line;
		}
		
		/** Escreve as configurações para o arquivo de configurações **/
		if ( $this->write($data)) {
			$this->close();
			return true;
		}
		$this->close();
		return false;
	}
	
	/**
	 * Realiza um parse no array de dados a ser gravado em disco.
	 * 
	 * @see VFWriterInterface::parse($data)
	 */
	public function parse($data) {
		$data = $data;
		$new = array();
		$type = null;
		foreach ($data as $type) {
			foreach ($type as $j => $k) {
				if ($j === strtoupper($j)) { 
					$new[$j] = $k;
				}
			}
		}
		$new = ArrayHelper::clean($new);
		return $new;
	}
	
	/**
	 * Retorna o nome do Writer.
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}
