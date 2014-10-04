<?php
VFAutoload::load('VFException', 'exception');
/**
 * Classe de Excessão para Views não encontradas.
 * Esta excessão é disparada sempre que um arquivo de view não for encontrado no diretório de views da página.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package view.exceptions
 */
class ViewNotFoundException extends VFException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see VFException::errorMessage
	 */
	protected $errorMessage = 'O template HTML para está página não foi encontrado.';
}