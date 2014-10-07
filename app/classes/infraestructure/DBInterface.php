<?php
/*
 * Interface de Métodos do Bnanco de Dados
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package infraestructure
 */

interface DBInterface {
	
	/** 
	 * Conecta no banco de dados.
	 * 
	 * @return void
	**/
	public function connect();
	
	/**
	 * Desconecta do banco de dados
	 * 
	 * @return void
	 */
	public function disconnect();
	
	/** 
	 * Seta as credenciais usadas na conexão com o banco de dados
	 * 
	 * @param string $dbhost
	 * @param string $dbuser
	 * @param string $dbpass
	 * @param string $dbname
	 * @return boolean
	**/
	public function configureCredentials($dbhost, $dbuser, $dbpass, $dbname);
	
	/** 
	 * Reliza consulta no banco de dados.
	 * @param string $query
	 * @param array $params
	 * @throws DBException
	 * @return boolean
	**/
	public function query($query, $params = NULL);
	
	/** 
	 * Realiza consulta no banco de dados e retorna resultado.
	 * 
	 * @param string $query
	 * @param array $params
	 * @param string $format
	 * @throws DBException
	 * @return array | int | boolean
	**/
	public function get($query, $params = NULL, $format = 'array');
}
