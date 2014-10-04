<?php
PDAutoload::load('PDAction', 'action');
/**
 * Esta classe estende a classe PDAction.
 * O objetivo padrão desta classe é oferecer atributos, validações e métodos que sirvam igualmente entre todas actions.
 * 
 * @author Pi Digital
 * @package bassis.actions
 */
class BasisAction extends PDAction {
	/**
	 * Array de módulos e actions que os usuários podem acessar mesmo estando offline.
	 * @name urlAllowed
	 * @access protected
	 * @var array 
	 */
	protected $urlAllowed = array('user' => array('index', 'login', 'logout'));
	
	/**
	 * Métodos a serem executados antes de a action ser executada.
	 * @name before
	 * @access protected
	 * @var array
	 */
	protected $before = array('userNotLoggedIn');
	
	/**
	 * Executa um ou mais métodos cadastrados para serem executados antes da action principal.
	 * 
	 * @param array $input
	 * @return void
	 */
	public function beforeRunning($input = array()) {
		$this->view = $input[1];
		foreach ($this->before as $method) {
			$this->$method($input[0], $input[1]);
		}
	}
	
	/**
	 * Redireciona o usuário para a página de login caso ele não esteja logado no sistema.
	 * 
	 * @param string $module
	 * @param string $action
	 * @return void
	 */
	public function userNotLoggedIn($module, $action) {
		global $User;
		if ( !$User->isLogged() && isset($this->urlAllowed[$module])) {
			if ( $this->urlAllowed[$module] == $action) {
				$this->redirect('user', 'login');
			}
		}
		else if ( !$User->isLogged()) {
			$this->redirect('user', 'login');
		}
	}
	
	/**
	 * Sobreescreve o método getMessage()
	 * 
	 * @see PDAction::getMessage()
	 */
	public function getMessage() {
		$message = parent::getMessage();
		if ( isset($message[1])) : 
		?>
			<div class="alert"><?php echo $message; ?> <a href="#" class="close" data-dismiss="alert">&times;</a></div>
		<?php
		endif;
	}
}
