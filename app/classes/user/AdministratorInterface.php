<?php
/**
 * Interface para a classe de Administrador.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user
 */
interface AdministratorInterface {
	/**
	 * Cadastra um Editor no banco de dados.
	 *
	 * @param User $User
	 * @return boolean
	 */
	public function addUser($User);
	
	/**
	 * Adiciona uma página no banco de dados.
	 * 
	 * @param AppPage $APPPage
	 * @return boolean
	 */
	public function addPage($AppPage);
}
