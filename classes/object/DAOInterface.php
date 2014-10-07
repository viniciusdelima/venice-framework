<?php
/**
 * Interface padrão para classes DAO utilizadas no sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package object
 */
interface DAOInterface {
	
	/**
	 * Insere dados no banco de dados.
	 * 
	 * @param Object $Object
	 * @return boolean
	 */
	public function insert($Object);
	
	/**
	 * Atualiza dados no banco de dados.
	 * 
	 * @param Object $Object
	 * @return boolean
	 */
	public function update($Object);
	
	/**
	 * Remove dados do banco de dados.
	 * 
	 * @param Object $Object
	 * @return boolean
	 */
	public function delete($Object);
	
	/**
	 * Recupera os dados do banco de dados.
	 * 
	 * @param Object $Object
	 * @return array
	 */
	public function get($Object);
}
