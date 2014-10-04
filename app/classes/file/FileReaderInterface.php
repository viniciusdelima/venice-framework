<?php
/**
 * Interface para a leitura de arquivos.
 * As classes que herdarem esta classe serão capazes de realizar a leitura de arquivos e informações sobre eles.
 * 
 * @author Pi Digital
 * @package file
 */
interface FileReaderInterface {
	/**
	 * Lê um arquivo.
	 * 
	 * @param string $mode
	 * @param $bytes
	 * @throws FileException
	 * @return mixed string | false
	 */
	public function read($mode = 'rt', $bytes = false);
	
}
