<?php
/**
 * Interface padrão de Usuário
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user
 */
interface UserInterface {
	
	/**
	 * Seta o id do usuário
	 * 
	 * @param int $id
	 * @return void
	 */
	public function setId($id);
	
	/**
	 * Seta o login do usuário.
	 * 
	 * @param string | int $login
	 * @return void
	 */
	public function setLogin($login);
	
	/**
	 * Seta a senha do usuário.
	 * 
	 * @param string $password
	 * @return void
	 */
	public function setPassword($password);
	
	/**
	 * Seta o nível do usuário
	 * 
	 * @param int $level
	 * @return void
	 */
	public function setLevel($level);
	
	/**
	 * Retorna o id do usuário
	 * 
	 * @return int
	 */
	public function getId();
	
	/**
	 * Retorna o login do usuário.
	 * 
	 * @return string | int
	 */
	public function getLogin();
	
	/**
	 * Retorna a senha do usuário.
	 * 
	 * @return string
	 */
	public function getPassword();
	
	/**
	 * Retorna o level do usuário
	 * 
	 * @return int
	 */
	public function getLevel();
	
	/**
	 * Faz o login do usuário no sistema.
	 * 
	 * @param string $login
	 * @param string $password
	 * @return boolean
	 */
	public function login($login = NULL, $password = NULL);
	
	/**
	 * Faz o logoff do usuário no sistema.
	 * 
	 * @return boolean
	 */
	public function logout();
	
	/**
	 * Recupera os dados do usuário.
	 * 
	 * @return boolean
	 */
	public function retrievesData();
	
	/**
	 * Cadastra o usuário no banco de dados
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function register($data = array());
	
	/**
	 * Verifica se o usuário está logado no sistema.
	 * Para um usuário estar logado no sistema ele precisa
	 * ter uma entrada no array global $_SESSION ativa.
	 * 
	 * @return boolean
	 */
	public function isLogged();
	
	/**
	 * Verifica se o usuário existe no banco de dados.
	 * 
	 * @return boolean
	 */
	public function exists();
	
}
