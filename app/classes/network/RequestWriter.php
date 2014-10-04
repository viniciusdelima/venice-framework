<?php
/**
 * Interface com métodos usados na construção de uma requisição a ser enviada para o cliente.
 * Esta interface fornece métodos úteis a entidades que desejem criar requisições a serem enviadas.
 * 
 * @author Pi Digital
 * @package network
 */
interface RequestWriter {
	/**
	 * Adiciona um header a lista de headers da requisição
	 * 
	 * @param string $header
	 * @return void
	 */
	public function addHeader($header);
}
