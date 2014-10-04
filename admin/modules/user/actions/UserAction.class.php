<?php
PDAutoload::loadModule('Basis');
/**
 * Esta classe representa ações do modulo de usuário dentro do sistema como login e cadastro.
 * 
 * @author Pi Digital
 * @package user.actions
 */
class UserAction extends BasisAction {
	
	/**
	 * Index do módulo.
	 * 
	 * @return void
	 */
	public function index() {
		echo 'Olá mundo';
	}
	
	/**
	 * Exibe a página de login para o usuário.
	 * 
	 * @return void
	 */
	public function login($var = '') {
		global $User;
		$confirma = Validation::setVar('confirma', 'post');
		$login = Validation::setVar('login', 'post');
		$password = Validation::setVar('password', 'post');
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($confirma)) {
			if ( $User->login($login, $password) ) {
				$this->redirect('dashboard');
			}
			else {
				echo 'falha ao logar';
			}
		}
	}
	
	/**
	 * Faz o logout do usuário
	 * 
	 * @return void
	 */
	public function logout() {
		global $User;
		if ( $User->isLogged()) {
			$User->logout();
			$this->redirect('user', 'login');
		}
	}
	
	/**
	 * Cadastra um usuário no banco de dados.
	 * 
	 * @return void
	 */
	public function register() {
		global $User;
		
		/** Se o usuário não for um Administrador **/
		if (false == $User instanceof Administrator) {
			$this->redirect('dashboard');
		}
		
		$login = Validation::setVar('login', 'post');
		$password = Validation::setVar('password', 'post');
		$level = Validation::setVar('level', 'post');
		$register = Validation::setVar('register', 'post');
		$name = Validation::setVar('name', 'post');
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($register)) {
			if ($User instanceof Administrator) {
				if ( $User->addUser( UserFactory::createInstance($level, array('login' => $login, 'password' => $password, 'level' => $level, 'name' => $name)))) {
					$this->setMessage('Usuário cadastrado com sucesso.');
					$this->redirect('dashboard', 'register');
				}
				$this->setMessage('Erro ao cadastrar usuário.');
				$this->redirect('dashboard', 'register');
			}
			$this->setMessage('Erro ao cadastrar usuário.');
			$this->redirect('dashboard');
		}
		else {
			$this->redirect('dashboard', 'register');
		}
	}
}
