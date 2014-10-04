<?php
PDAutoload::load('FileReaderInterface', 'file');
PDAutoload::load('FileWriterInterface', 'file');
PDAutoload::load('FileException', 'file.exceptions');
/**
 * Classe para a manipulação de arquivos no sistema.
 * Esta classe terá por objetivo manipular e gerênciar a leitura e escrita de arquivos pelo sistema.
 * Para isso serão implementadas as interfaces FileReader e FileWriter.
 * 
 * @author Pi Digital
 * @package file
 */
class File implements FileReaderInterface, FileWriterInterface {
	/**
	 * Caminho para o arquivo.
	 * @name path
	 * @access protected
	 * @var string
	 */
	protected $path;
	
	/**
	 * Link para a leitura e escrita no arquivo
	 * @name handle
	 * @access protected
	 * @var resource
	 */
	protected $handle;
	
	/**
	 * Indica se o arquivo de fato existe no disco.
	 * @name exists
	 * @access protected
	 * @var boolean
	 */
	protected $exists = false;
	
	/**
	 * Informações do arquivo
	 * @name $info
	 * @access protected
	 * @var array
	 */
	protected $info = array();
	
	/**
	 * Construtor da classe.
	 * 
	 * @param string $path
	 * @param boolean $create
	 * @return void
	 */
	public function __construct($path, $create = false) {
		$this->path = $path;
		true === $this->exists($path, $create) ? $this->exists = true : $this->exists = false;
	}
		
	/**
	 * Verifica se o arquivo existe "fisicamente".
	 * 
	 * @param string $path
	 * @param boolean $create
	 * @return void
	 */
	public function exists($path, $create = false) {
		if ( file_exists($path)) {
			return true;
		}
		else if (true === $create) {
			return true;
		}
		return false;
	}
	
	/**
	 * Abre um arquivo.
	 * 
	 * @param string $mode
	 * @param int $bytes
	 * @throws FileException
	 * @return boolean
	 */
	public function open($mode) {
		if ( true === $this->exists ) {
			$handle = fopen($this->path, $mode);
			if ($handle) {
				$this->handle = $handle;
				return true;
			}
			else {
				throw new FileException('Erro ao abrir arquivo ' . $this->path);
				return false;
			}
		}
		else {
			throw new FileException('O arquivo não existe no caminho' . $this->path);
			return false;
		}
		return false;
	}
	
	/**
	 * Fecha o arquivo
	 * 
	 * @return boolean
	 */
	public function close() {
		if ( !isset($this->handle)) {
			return true;
		}
		return fclose($this->handle);
	}
	
	/**
	 * Lê um arquivo.
	 * 
	 * @see FileReader::read($mode = 'rt', $bytes = false)
	 */
	public function read($mode = 'rt', $bytes = false) {
		if ( (false === $bytes || $bytes <= 0) && true === $this->exists($this->path)) {
			return file_get_contents($this->path);
		}
		else if ( is_numeric($bytes) && $bytes > 0) {
			$this->open($mode);  // Abre o arquivo
			return fread($this->handle, $bytes);
		}
		else {
			throw new FileException('Arquivo inexistente.');
			return false;
		}
	}
	
	/**
	 * Escreve um arquivo.
	 * 
	 * @see FileWriter::write($data, $mode = 'wt')
	 */
	public function write($data, $line = false, $mode = 'wt') {
		if ( $this->open($mode) ) {
			if (true === $line) {
				$data != "\n" && isset($data[4]) ? $data = $data . "\n" : $data;
			}
			if ( fwrite($this->handle, $data) ) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Adiciona conteúdo ao conteúdo existente no arquivo.
	 * 
	 * @see FileWriter::append($data)
	 */
	public function append($data) {
		return $this->write($data, 'at');
	}
	
	/**
	 * Retorna um array de informações sobre o arquivo.
	 * 
	 * @throws FileException
	 * @return array
	 */
	public function info() {
		if ( true === $this->exists ) {
			empty($this->info) ? $this->info = pathinfo($this->path) : $this->info;
			
			if ( !empty($this->info)) {
				return true;
			}
			return false;
		}
		throw new FileException('Este arquivo não existe.');
		return false;
	}
	
	/**
	 * Retorna o nome do arquivo
	 * 
	 * @return string | false
	 */
	public function getName() {
		empty($this->info) ? $this->info() : $this->info;
		
		if ( isset($this->info['filename'])) {
			return $this->info['filename'];
		}
		return false;
	}
	
	/**
	 * Retorna a extensão do arquivo
	 *
	 * @return string | false
	 */
	public function getExtension() {
		empty($this->info) ? $this->info() : $this->info;
	
		if ( isset($this->info['extension'])) {
			return $this->info['extension'];
		}
		return false;
	}
	
	/**
	 * Retorna um array correspondendo a cada linha do arquivo.
	 * 
	 * @return array
	 */
	public function getArr() {
		$data = file($this->path);
		return $data;
	}
}
