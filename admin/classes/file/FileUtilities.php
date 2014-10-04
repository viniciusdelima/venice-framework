<?php
/**
 * Esta interface fornece métodos utilitários na manipulação de arquivos.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
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
