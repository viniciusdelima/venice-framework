<?php
/**
 * Interface padrão para a escrita no arquivo de configurações do sistema.
 * Esta interface fornece métodos que serão usados na interpretação
 * e escrita do arquivo de configurações do sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package core
 */
interface VFWriterInterface {
	/**
	 * Realiza um parser no array de configurações
	 * formando a string a ser gravada em arquivo.
	 * 
	 * @param array $data
	 * @return string
	 */
	public function parse($data);
}
