<?php
/**
 * Interface padrão de uma App Page.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package app
 */
interface AppPageInterface {
	/**
	 * Adiciona uma página no banco de dados
	 * 
	 * @param AppPage $AppPage
	 * @throws AppPageExistsException
	 * @return boolean
	 */
	public function insert($AppPage);
	
	/**
	 * Atualiza uma página no banco de dados.
	 * 
	 * @param AppPage $AppPage
	 * @return boolean
	 */
	public function update($AppPage);
	
	/**
	 * Deleta uma página do banco de dados.
	 * 
	 * @return boolean
	 */
	public function delete();
}
