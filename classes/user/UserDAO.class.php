<?php
VFAutoload::load('DAOInterface', 'object');

/**
 * Classe DAO para usuário.
 * Esta classe têm como objetivo servir de classe base para todos usuários 
 * e realizar as tarefas mais comuns como inserção de usuários no banco, atualização e remoção.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user
 */
abstract class UserDAO implements DAOInterface {
	/**
	 * Tipo da classe dao.
	 * @name type
	 * @access protected
	 * @var string
	 */
	protected $type;
	
	/**
	 * Construtor da classe.
	 * Este construtor recebe por parâmetro o tipo da classe DAO.
	 * 
	 * @param string $type
	 * @return void
	 */
	public function __construct($type) {
		$this->type = $type;
	}
	
	/**
	 * Insere um usuário no banco de dados.
	 *
	 * @see DAOInterface::insert($Object)
	 */
	public function insert($User) {
		if ($User instanceof $this->type) {
			$DB = DBFactory::getInstance();
			try {
				$login = Validation::antiInjection($User->getLogin());
				$password = Validation::encript( Validation::antiInjection( $User->getPassword()));
				$level = (int) $User->getLevel();
				$name = Validation::antiInjection($User->getName());
				if ( $DB->query('INSERT INTO pd_admin_users SET admin_login=?, admin_password=?, admin_level=?, admin_name=?, admin_register_date=?', array($login, $password, $level, $name, time()))) {
					return true;
				}
				throw new RegisterException('Não foi possível cadastrar o usuário no banco de dados.');
				return false;
			}
			catch (DBException $e) {
				throw $e;
				return false;
			}
			catch (Exception $e) {
				throw $e;
				return false;
			}
		}
		return false;
	}
	
	/**
	 * Retorna um array contendo os dados do usuário salvo no banco de dados.
	 *
	 * @param {$type} $User
	 * @return array
	 */
	public function get($User) {
		if ($User instanceof $this->type) {
			try {
				$DB = DBFactory::getInstance();
				$login = Validation::antiInjection( $User->getLogin());
				$data = $DB->get('SELECT * FROM pd_admin_users WHERE admin_login=?', array($login));
				if ( $data > 0) {
					return $data;
				}
				throw new LoginException('O usuário informado não existe, por favor verifique e tente novamente.');
			}
			catch (DBException $e) {
				return $e;
			}
			catch (VFException $e) {
				throw $e;
			}
		}
	}
	
	/**
	 * Atualiza um usuário no banco de dados.
	 *
	 * @see DAOInterface::update($Object)
	 */
	public function update($User) {
		if ($User instanceof $this->type) {
	
		}
	}
	
	/**
	 * Remove um usuário do banco de dados.
	 *
	 * @see DAOInterface::delete($Object)
	 */
	public function delete($User) {
		if ($User instanceof $this->type) {
	
		}
	}
	
	/**
	 * Verifica se determinado usuário existe no banco de dados.
	 *
	 * @param {$type} $User
	 * @throws DBException
	 * @return boolean
	 */
	public function exists($User) {
		if ($User instanceof $this->type) {
			$dbh = DBFactory::getInstance();
			$login = Validation::antiInjection($User->getLogin());   // Evita sql_injection
			try {
				$count = $dbh->get('SELECT COUNT(*) FROM pd_admin_users WHERE admin_login=?', array($login));
				return $count[0][0] > 0;
			}
			catch (DBException $e) {
				throw $e;
				return false;
			}
		}
		return false;
	}
}
