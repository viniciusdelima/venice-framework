<?php
VFAutoload::load('UserDAO', 'user');

/**
 * Classe DAO de um Administrador.
 * Esta classe será responsável por gerênciar a comunicação de um Administrador como banco de dados.
 * Através desta classe seram feitas todas as requisições, obtenções, inserções e alterações de dados no banco de dados.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user
 */
class AdministratorDAO extends UserDAO {
	/**
	 * Construtor da classe
	 *
	 * @see UserDAO::__construct($type)
	 */
	public function __construct() {
		parent::__construct('Administrator');
	}
	
	/**
	 * Cadastra um usuário no banco de dados.
	 * 
	 * @param User $User
	 * @throws DBException, VFException, Exception
	 * @return boolean
	 */
	public function addUser($User) {
		if ( !$User->exists()) {
			$DB       = DBFactory::getInstance();
			$login    = Validation::antiInjection( $User->getLogin());
			$password = Validation::encript( Validation::antiInjection( $User->getPassword()));
			$level    = Validation::antiInjection( $User->getLevel());
			$name     = Validation::antiInjection( $User->getName());
			
			try {
				if ( $DB->query('INSERT INTO pd_admin_users SET admin_login=?, admin_password=?, admin_level=?, admin_name=?, admin_register_date=?', array($login, $password, $level, $name, time()))) {
					return true;
				}
			return false;
			}
			catch (DBException $e) {
				throw $e;
				return false;
			}
			catch (VFException $e) {
				throw $e;
				return false;
			}
		}
		throw new VFException('O usuário informado já existe no banco de dados.');
		return false;
	}
}
