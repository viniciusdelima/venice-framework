<?php
/**
 * Interface padrão de uma FAQ.
 * Esta interface fornece os métodos necessários para a criação e gerênciamento de uma FAQ.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package app
 */
interface FAQElementInterface {
	/**
	 * Seta uma operação e array de dados gerenciados no banco de dados.
	 * 
	 * @param string $operation
	 * @return void
	 */
	public function set($operation);
	
	/**
	 * Remove uma pergunta do array de perguntas da FAQ.
	 * 
	 * @return void
	 */
	public function remove();
	
	/**
	 * Atualiza uma pergunta do array de perguntas da FAQ.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function update(array $data);
	
	/**
	 * Salva a FAQ no banco de dados.
	 * 
	 * @return boolean
	 */
	public function save();
	
	/**
	 * Recupera os dados do banco de dados.
	 * 
	 * @return void
	 */
	public function retrievesData();
	
	/**
	 * Recupera os dados de todos FAQElements que pertençam a certa página.
	 * 
	 * @param 
	 */
}
