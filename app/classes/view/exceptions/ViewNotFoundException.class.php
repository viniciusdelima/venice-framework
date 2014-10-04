<?php
PDAutoload::load('PDException', 'exception');
/**
 * Classe de Excessão para Views não encontradas.
 * Esta excessão é disparada sempre que um arquivo de view não for encontrado no diretório de views da página.
 * 
 * @author Pi Digital
 * @package view.exceptions
 */
class ViewNotFoundException extends PDException {
	/**
	 * Mensagem de erro padrão
	 *
	 * @see PDException::errorMessage
	 */
	protected $errorMessage = 'O template HTML para está página não foi encontrado.';
}