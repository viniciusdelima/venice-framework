<?php

PDAutoload::load('DBInterface', 'infraestructure');
PDAutoload::load('DBException', 'infraestructure.exceptions');

/**
 * Classe de banco de dados
 * 
 * @author Pi Digital
 * @package infraestructure
 */
class DB implements DBInterface {
	/**
	 * Dados usados na conexão com o banco de dados.
	 * @name credentials
	 * @access private
	 * @var array 
	 */
	private $credentials = array();
	
	/**
	 * Link de conexão com o banco de dados
	 * @name conn
	 * @access private
	 * @var PDO
	 */
	private $conn;
	
	/**
	 * Construtor da classe
	 * 
	 * @return void
	 */
	public function __construct() {
		
	}
	
	/**
	 * Realiza conexão com o banco de dados
	 * @see DBInterface::connect()
	 */
	public function connect() {
		
		if ( !empty($this->credentials)) {
			$dsn = 'mysql:dbname=' . $this->credentials['dbname'] . ';host=' . $this->credentials['dbhost'];
			$username = $this->credentials['dbuser'];
			$passwd = $this->credentials['dbpass'];
			$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
			
			try {
				$this->conn = new PDO($dsn, $username, $passwd, $options);
				if (false == $this->conn || empty($this->conn)) {
					throw new DBException(1, 'Erro ao estabelecer conexão com o banco de dados.');
					return false;
				}
				return true;
			}
			catch (PDOException $e) {
				throw new DBException(2, $e->getMessage());
				return false;
			}
		}
		throw new DBException(0, 'Credenciais não configuradas.');
		return false;
	}
	
	/**
	 * Desconecta do banco de dados.
	 * @see DBInterface::disconnect()
	 */
	public function disconnect() {
		unset($this->conn);
	} 
	
	/**
	 * Seta as credenciais de conexão com o banco de dados.
	 * 
	 * @see DBInterface::configureCredentials($dbhost, $dbuser, $dbpass, $dbname)
	 */
	public function configureCredentials($dbhost, $dbuser, $dbpass, $dbname) {
		$this->credentials = array('dbhost' => $dbhost, 'dbuser' => $dbuser, 'dbpass' => $dbpass, 'dbname' => $dbname);
	}
	
	/**
	 * Realiza uma consulta no banco de dados.
	 * 
	 * @see DBInterface::query($query, $params)
	 */
	public function query($query, $params = array()) {
		if ( !empty($query)) {
			$sth = $this->conn->prepare($query);
			try {
				if ( $sth->execute($params)) {
					return true;
				}
				throw new DBException(3, 'Erro ao executar query no banco de dados.');
				return false;
			}
			catch (PDOException $e) {
				throw new DBException(3, $e->getMessage());
				return false;
			}
		}
		return false;
	}
	
	/**
	 * Realiza uma consulta no banco de dados e retorna dados.
	 * 
	 * @see DBInterface::get($query, $params, $format)
	 */
	public function get($query, $params = array(), $format = 'array') {
		if ( !empty($query)) {
			$sth = $this->conn->prepare($query);
			try {
				if ( $sth->execute($params)) {
					$data = $sth->fetchAll();
					return $data;
				}
				throw new DBException(3, 'Erro ao executar query no banco de dados.');
				return false;
			}
			catch (PDOException $e) {
				throw new DBException(3, $e->getMessage());
				return false;
			}
		}
		return false;
	}
}
