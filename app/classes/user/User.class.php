<?php
PDAutoload::load('UserInterface', 'user');
PDAutoload::load('LoginException', 'user.exceptions');
PDAutoload::load('RegisterException', 'user.exceptions');
PDAutoload::load('UserNotFoundException', 'user.exceptions');

/**
 * Classe abstrata de Usuário.
 * Esta classe servirá como base para a classe Employee e outras classes de Usuários que terão acesso ao hotsite
 * 
 * @author Pi Digital
 * @package user
 */
abstract class User implements UserInterface {
	/**
	 * ID do usuário no banco de dados.
	 * @name id
	 * @access protected
	 * @var int
	 */
	protected $id;
	
	/**
	 * Login do usuário
	 * @name login
	 * @access protected
	 * @var string | int
	 */
	protected $login;
	
	/**
	 * Senha do usuário
	 * @name password
	 * @access protected
	 * @var string
	 */
	protected $password;
	
	/**
	 * Nível do usuário
	 * @name level
	 * @access protected
	 * @var int
	 */
	protected $level;
	
	/**
	 * Nome do usuário
	 * @name name
	 * @access protected
	 * @var string
	 */
	protected $name;
	
	/**
	 * DAO do usuário.
	 * @name dao
	 * @access protected
	 * @var Object
	 */
	protected $dao;
	
	/**
	 * Construtor da classe.
	 * 
	 * @param Object $dao
	 * @param array $data
	 * @return void
	 */
	public function __construct($dao, $data = array()) {
		$this->dao = $dao;
		// Seta os dados do usuário
		isset($data['id'])       ? $this->id       = $data['id']       : $data;
		isset($data['login'])    ? $this->login    = $data['login']    : $data;
		isset($data['password']) ? $this->password = $data['password'] : $data;
		isset($data['level'])    ? $this->level    = $data['level']    : $data;
		isset($data['name'])     ? $this->name     = $data['name']     : $data;
	}
	
	/**
	 * Seta o id do usuário
	 * 
	 * @see UserInterface::setId($id)
	 */
	public function setId($id) {
		$this->id = (int) $id;
	}
	
	/**
	 * Seta o login do usuário
	 * 
	 * @see UserInterface::setLogin($login)
	 */
	public function setLogin($login) {
		$this->login = $login;
	}
	
	/**
	 * Seta a senha do usuário
	 * 
	 * @see UserInterface::setPassword($password)
	 */
	public function setPassword($password) {
		$this->password = $password;
	}
	
	/**
	 * Seta o nível do usuário
	 * 
	 * @see UserInterface::setLevel($level)
	 */
	public function setLevel($level) {
		$this->level = (int)$level;
	}
	
	/**
	 * Seta o nome do usuário
	 * 
	 * @see UserInterface::setName($name)
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Retorna o id do usuário
	 * 
	 * @see UserInterface::getId()
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Retorna o login do usuário
	 * 
	 * @see UserInterface::getLogin()
	 */
	public function getLogin() {
		return $this->login;
	}
	
	/**
	 * Retorna a senha do usuário
	 * 
	 * @see UserIterface::getPassword()
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * Retorna o nível do usuário
	 * 
	 * @see UserInterface::getLevel()
	 */
	public function getLevel() {
		return $this->level;
	}
	
	/**
	 * Retorna o nome do usuário
	 * 
	 * @see UserInterface::getName()
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Efetua o login do usuário no sistema.
	 * 
	 * @see UserInterface::login()
	 */
	public function login($login = NULL, $password = NULL) {
		!empty($login)    ? $this->login = $login : $login;
		!empty($password) ? $this->password = $password : $password;
		$pointer = &$this;
		
		if ( $this->dao->exists($pointer)) {
			$data = $this->dao->get($pointer);
			$this->id       = $data[0]['user_id'];
			$this->login    = $data[0]['user_login'];
			$this->password = $data[0]['user_password'];
			$this->level    = $data[0]['user_level'];
			$this->name     = $data[0]['user_name'];
			Session::insert( array('sid' => Validation::encriptSession( time() . $data[0]['user_login'] . $data[0]['user_password']), 'id' => $data[0]['user_id'],'login' => $data[0]['user_login'], 'level' => $data[0]['user_level'], 'name' => $data[0]['user_name']), 'user');
			return true;
		}
		throw new LoginException('Não foi possível logar no sistema,por favor verifique se sua senha e login estão corretos.', 4);
		return false;
	}
	
	/**
	 * Efetua o logoff do usuário no sistema.
	 * 
	 * @see UserInterface::logoff()
	 */
	public function logout() {
		if ( $this->isLogged()) {
			// Remove a entrada do usuário da sessão
			Session::destroy();
		}
	}
	
	/**
	 * Recupera os dados do usuário no banco de dados.
	 * 
	 * @see UserInterface::retrievesData()
	 */
	public function retrievesData() {
		$pointer = &$this;
		$data = $this->dao->get($pointer);
		if ( count($data) > 0) {
			$this->id       = $data[0]['user_id'];
			$this->login    = $data[0]['user_login'];
			$this->password = $data[0]['user_password'];
			$this->level    = $data[0]['user_level'];
			$this->name     = $data[0]['user_name'];
		}
		else {
			throw new UserNotFoundException();
		}
	}
	
	/**
	 * Cadastra o usuário no banco de dados
	 * 
	 * @see UserInterface::register($data = array())
	 */
	public function register($data = array()) {
		if ( !empty($data)) {
			$this->login = $data['login'];
			$this->password = $data['password'];
			$this->level = $data['level'];
			$this->name = $data['name'];
			$pointer = &$this;
			$this->dao->insert($pointer);
		}
	}
	
	/**
	 * Verifica se o usuário está logado.
	 * 
	 * @see UserInterface::isLogged()
	 */
	public function isLogged() {
		$user_entrie = Session::getValue('user');
		if ( isset($user_entrie['sid'])) {
			return $user_entrie['level'] == $this->level;
		}
		return false;
	}
	
	/**
	 * Verfica se o usuário existe no banco de dados.
	 * 
	 * @see UserInterface::exists()
	 */
	public function exists() {
		$pointer = &$this;
		return $this->dao->exists($pointer);
	}
}
