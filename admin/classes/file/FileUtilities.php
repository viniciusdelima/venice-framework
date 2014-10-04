<?php
/**
 * Esta interface fornece métodos utilitários na manipulação de arquivos.
 * 
 * @author Pi Digital
 * @package file
 */
interface FileUtilities {
	/**
	 * Retorna a extensão de um arquivo.
	 * 
	 * @param string $filename
	 */
	public static function getMimeType($filename);
}
