<?php
PDAutoload::load('User', 'user');
PDAutoload::load('Administrator', 'user');
PDAutoload::load('AdministratorDAO', 'user');
PDAutoload::load('Editor', 'user');
PDAutoload::load('EditorDAO', 'user');
PDAutoload::load('Factory', 'object');

/**
 * Classe Factory para a instanciação de usuários no sistema.
 * Esta classe será responsável por devolver uma instância de um usuário Administrador ou
 * um usuário Editor.
 * 
 * @author Pi Digital
 * @package user
 */
class UserFactory extends Factory {
	
	/**
	 * @see object.Factory::$instance
	 * @override instance
	 */
	protected static $instance;
	
	/**
	 * Classe DAO do usuário
	 * @name dao
	 * @access private
	 * @var EditorDAO | AdministratorDAO
	 */
	protected static $dao;
	
	/**
	 * Tipos de usuários aceitoe pelo sistema.
	 * @name types
	 * @access protected
	 * @var array
	 */
	protected static $types = array('administrator' => 1, 'editor' => 2);
	
	/**
	 * Construtor privado da classe
	 * 
	 * @return void
	 */
	private function __construct() {
		
	}
	
	/**
	 * Retorna uma instância de usuário
	 * 
	 * @return Administrator | Editor | boolean
	 */
	public static function getInstance() {
		if ( !isset(self::$instance)) {
			
			// Verifica se o usuário possui alguma sessão ativa no array session
			$user_entrie = Session::getValue('user');
			
			// Verifica se a sessão do usuário existe
			if ( $user_entrie != false && $user_entrie['id'] > 0 && isset($user_entrie['level']) && isset($user_entrie['sid'])) {
				$type = '';
				switch ($user_entrie['level']) {
					case 1 : $type = 'Administrator';
						break;
					case 2 : $type = 'Editor';
						break;
					default : throw UserInvalidException('Sessão inválida, por favor logue novamente.');
				}
				
				$dao = $type . 'DAO';
				$dao = new $dao();                        // Instância DAO do Usuário
				$data = array('id' => $user_entrie['id'], 'login' => $user_entrie['login'], 'level' => $user_entrie['level']);
				self::$dao = &$dao;
				self::$instance = new $type(self::$dao, $data);  // Instância Usuário
				self::$instance->retrievesData();
				return self::$instance;
			}
			
			// Sessão do usuário não existe
			else {
				/**
				 * Por motivos de segurança, caso o usuário não esteja logado,
				 * devolvemos como instância padrão um Editor sem level setado.
				 */
				$dao = new EditorDAO();
				self::$dao = &$dao;
				self::$instance = new Editor(self::$dao);
				return self::$instance;
			}
		}
		return self::$instance;
	}
	
	/**
	 * Cria uma instância de usuário com base no tipo passado por parâmetro
	 * 
	 * @param int $level
	 * @param array $data
	 * @return User
	 */
	public static function createInstance($level, $data = array()) {
		if (in_array($level, self::$types)) {
			switch ((int) $level) {
				case 1 : 
					$type = 'Administrator';
					break;
				case 2 : 
					$type = 'Editor';
					break;
			}
			$dao = $type . 'DAO';
			$dao = new $dao();
			$instance = new $type($dao, $data);
			return $instance;
		}
	}
}
