<?php
PDAutoload::load('User', 'user');
PDAutoload::load('AdministratorInterface', 'user');
PDAutoload::load('FormInterface', 'form');
PDAutoload::load('AppPageInterface', 'app');

/**
 * Classe de Administrador.
 * Esta classe herda a classe base usuário e têm por objetivo representar um Administrador do sistema.
 * 
 * @author Pi Digital
 * @abstract User
 * @package user
 */
class Administrator extends User implements AdministratorInterface, FormInterface {
	
	/**
	 * Construtor da classe, inicia a classe e seta o endereço na memória de sua respectiva classe DAO
	 * 
	 * @param AdministratorDAO $dao
	 * @see User::_construct($dao, $data = array())
	 * @return void 
	 */
	public function __construct(AdministratorDAO $dao, $data = array()) {
		parent::__construct($dao, $data);
	}
	
	
	/**
	 * Cadastra um Editor no banco de dados.
	 * 
	 * @see AdministratorInterface
	 */
	public function addUser($User) {
		try {
			if ( $this->dao->addUser($User)) {
				return true;
			}
			return false;
		}
		catch (PDException $e) {
			return false;
		}
		catch (Exception $e) {
			return false;
		}
	}
	
	/**
	 * Adiciona um campo ao formulário de cadastro.
	 * 
	 * @see FormInterface::addField(Field $Field)
	 */
	public function addField(Field $Field) {
		if ( $Field->register()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Remove um campo do formulário de cadastro.
	 * 
	 * @see FormInterface::removeField(Field $Field)
	 */
	public function removeField(Field $Field) {
		
	}
	
	/**
	 * Atualiza um campo do formulário de cadastro.
	 * 
	 * @see FormInterface::updateForm(Field $Field)
	 */
	public function updateForm(Field $Field) {
		if ( $Field->update()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Retorna um array de campos usados em um determinado formulário.
	 * 
	 * @see FormInterface::getAllFields(Field $Field)
	 */
	public function getAllFields(Field $Field) {
		$data = $Field->getAll();
		return $data;
	}
	
	/**
	 * Adiciona uma página para a visão do usuário (app)
	 * 
	 * @param AppPage $AppPage
	 * @return boolean
	 */
	public function addPage($AppPage) {
		return $AppPage->insert($AppPage);
	}
	
	/**
	 * Remove uma página do banco de dados.
	 * 
	 * @param AppPage $AppPage
	 * @return boolean
	 */
	public function removePage($AppPage) {
		return $AppPage->delete();
	}
	
	/**
	 * Atualiza a FAQ.
	 * 
	 * @param FAQ $FAQ
	 * @return boolean
	 */
	public function updateFAQ($FAQ) {
		return $FAQ->save();
	}
}
