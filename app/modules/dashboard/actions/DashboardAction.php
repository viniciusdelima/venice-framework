<?php
PDAutoload::loadModule('Basis');
/**
 * Esta classe possui as ações do módulo Dashboard do sistema.
 * O módulo dashboard é o destino do usuário com poderes administrativos após logar no sistema.
 * 
 * @author Pi Digital
 * @package dashboard.actions
 */
class DashboardAction extends BasisAction {
	/**
	 * Index do módulo.
	 *
	 * @return void
	 */
	public function index() {
		
	}
	
	/**
	 * Registra um usuário no sistema
	 * 
	 * @return void
	 */
	public function register() {
		global $User;
		if ( !$User->isLogged()) {
			$this->redirect('user', 'login');
		}
		else if (false == $User instanceof Administrator) {
			$this->redirect('dashboard');
		}
		else {
			echo $this->getMessage('message');
		}
	}
	
	/**
	 * Configurações gerais do sistema.
	 * 
	 * @return void
	 */
	public function settings() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$sname = Validation::setVar('sname', 'post');
			$email = Validation::setVar('email', 'post');
			$activated = Validation::setVar('activated', 'post');
			$activated == 'on' ? $activated = 1 : $activated = 0;
			$data = array('SITE_NAME' => $sname, 'PRIMARY_EMAIL' => $email, 'ACTIVATED_ENTRIES' => $activated);
			Configure::write('PREFERENCES', $data);
			if ( Configure::update('pd') ) {
				$this->setMessage('Configurações atualizadas com sucesso.');
			}
			else {
				$this->setMessage('Erro ao atualizar configurações.');
			}
		}
		
		$preferences = Configure::read('PREFERENCES');
		$config = array('site_name' => $preferences['SITE_NAME'], 'primary_email' => $preferences['PRIMARY_EMAIL'], 'activated_entries' => $preferences['ACTIVATED_ENTRIES']);
		$this->set('config', $config);
	}
}
