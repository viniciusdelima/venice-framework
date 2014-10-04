<?php 
PDAutoload::loadModule('Basis');
PDAutoload::load('FAQElementFactory', 'app');
PDAutoload::load('AppPageFactory', 'app');
/**
 * Classe responsável por gerênciar e executar as actions do gerênciamento da FAQ da visão do usuário (app).
 * 
 * @author Pi Digital
 * @package faq.actions
 */
class FAQAction extends BasisAction {
	/**
	 * Index
	 * 
	 * @return void
	 */
	public function index() {
		$FAQ = new FAQElementFactory($dao);
		$data = $FAQ->getAll();
		$this->set('faq', $data);
	}
	
	/**
	 * Adiciona uma pergunta a FAQ.
	 * 
	 * @return void
	 */
	public function add() {
		global $User;
		$question = Validation::setVar('question', 'post');
		$response = Validation::setVar('response', 'post');
		$page     = Validation::setVar('page', 'post');
		$data = array('question' => $question, 'response' => $response, 'page' => $page);
		$dao = new FAQDAO();
		$pointer = &$dao;
		$FAQ = new FAQ($pointer);
		
		if ( isset($question[1]) && isset($response[1]) && is_numeric($page)) {
			$AppPage = AppPageFactory::getInstance();
			$AppPage->setPropertie('id', $page);
			if ( $AppPage->exists()) {
				$FAQ->add($data);
				if ( $User->updateFAQ($FAQ)) {
					$this->setMessage('Pergunta adicionada com sucesso.');
				}
				else {
					$this->setMessage('Erro ao adicionar pergunta.');
				}
			}
			else {
				$this->setMessage('A página selecionada não existe.');
			}
		}
		else {
			$this->setMessage('Erro ao cadastrar pergunta no sistema.');
		}
		$this->redirect('FAQ');
	}
	
	/**
	 * Remove uma pergunta da FAQ.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function remove($data) {
		if ( isset($data[0])) {
			if ( is_numeric($data[0])) {
				$dao = new FAQDAO();
				$dao = &$dao;
				$FAQ = new FAQ($dao);
				
				$id = $data[0];
				$entrie = $FAQ->getQuestion($id);
				
				if ( count($entrie) > 0) {
					$FAQ->remove($entrie) ? $this->setMessage('Pergunta excluida com sucesso.') : $this->setMessage('Erro ao excluir pergunta.');
				}
				else {
					$this->setMessage('Esta pergunta não existe.');
				}
			}
			$this->setMessage('Pergunta inválida.');
		}
		$this->setMessage('Nenhuma pergunta foi selecionada.');
		$this->redirect('faq');
	}
}