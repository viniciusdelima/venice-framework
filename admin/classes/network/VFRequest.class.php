<?php
VFAutoload::load('RequestWriter', 'network');

/**
 * Classe para manipular requisições ao sistema.
 * Através desta classe é feita também a leitura de arquivos js, xml, css e demais arquivos que não páginas ou scripts.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package network
 */
class VFRequest implements RequestWriter {
	
	/**
	 * Dados a serem enviados na requisição.
	 * @name data
	 * @access private
	 * @var array
	 */
	private $data = array();
	
	/**
	 * Código de resposta da requisição.
	 * @name responseCode
	 * @access private
	 * @var string
	 */
	private $responseCode;
	
	/**
	 * Cabeçalhos da requisição
	 * @name headers
	 * @access protected
	 * @var array
	 */
	protected $headers = array();
	
	/**
	 * Construtor da classe
	 * 
	 * @return void
	 */
	public function __construct() {
		
	}
	
	/**
	 * Completa um requisição a enviando para o cliente.
	 * 
	 * @return boolean
	 */
	public function sent() {
		$ob_content = ob_get_contents();
		ob_clean();
		
		foreach ($this->headers as $header) {
			header($header);
		}
		echo $ob_content;
		exit();
	}
	
	/**
	 * Adiciona um header a lista de headers a serem enviados na requisição.
	 * 
	 * @see RequestWriter::addHeader($header)
	 */
	public function addHeader($header) {
		$this->headers[] = $header;
	}
}
