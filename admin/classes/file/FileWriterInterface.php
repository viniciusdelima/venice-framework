<?php
/**
 * Interface de escrita de arquivos.
 * Esta interface fornece métodos responsáveis pela escrita de arquivos no sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package file
 */
interface FileWriterInterface {
	/**
	 * Escreve os dados para um arquivo.
	 * 
	 * @param string $data
	 * @param boolean $line
	 * @param string $mode
	 * @return boolean
	 */
	public function write($data, $line = false, $mode = 'wt');
	
	/**
	 * Adiciona conteúdo ao conteúdo existente no arquivo.
	 * 
	 * @param string $data
	 * @return boolean
	 */
	public function append($data);
}
