<?php
VFAutoload::loadModule('Basis');
VFAutoload::load('AppPageFactory', 'app');
VFAutoload::load('FAQElementFactory', 'app');
/**
 * Classe responsável por gerênciar e executar as actions do gerênciamento de páginas da visão do usuário (app).
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package page.actions
 */
class PageAction extends BasisAction {
	/**
	 * Método index.
	 * 
	 * @return void
	 */
	public function index() {
		
	}
	
	/**
	 * Adiciona uma página no banco de dados.
	 * 
	 * @return boolean
	 */
	public function add() {
		global $User;
		$title   = Validation::setVar('title', 'post');
		$content = Validation::setVar('content', 'post');
		$visible = (int) Validation::setVar('visible', 'post');
		
		$AppPage = AppPageFactory::getInstance();
		$AppPage->setData( array('author' => $User->getId(), 'title' => $title, 'content' => $content, 'active' => $visible, 'register_date' => time()));
		
		try {
			if ( $User->addPage($AppPage)) {
				$this->setMessage('Página adicionada com sucesso.');
			}
			else {
				$this->setMessage('Erro ao adicionar página no banco de dados.');
			}
		}
		catch ( AppPageExistsException $e) {
			$this->setMessage('Esta página já está cadastrada no banco de dados.');
		}
		$this->redirect('page');
	}
	
	/**
	 * Lista as páginas criadas no através do painel Administrativo.
	 * 
	 * @return void
	 */
	public function listAll() {
		$AppPage = AppPageFactory::getInstance();
		$pages = $AppPage->getAll();
		$this->set('pages', $pages);
		$this->view = 'list';
	}
	
	/**
	 * Altera a visibilidade de uma página.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function changeVisibility($data) {
		if ( isset($data[0]) && isset($data[1])) {
			if ( is_numeric($data[0]) && is_numeric($data[1])) {
				$AppPage = AppPageFactory::getInstance();
				$AppPage->setData( array('id' => $data[0]));
				$AppPage->retrievesData();
				$AppPage->setPropertie('active', $data[1]);
				$pointer = &$AppPage;
				$AppPage->update($pointer);
			}
		}
		$this->redirect('page', 'listall');
	}
	
	/**
	 * Deleta uma página do banco de dados.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function delete(array $data) {
		global $User;
		if ( count($data) > 0) {
			if ( is_numeric($data[0])) {
				$AppPage = AppPageFactory::getInstance();
				$AppPage->setPropertie('id', $data[0]);
				$User->removePage($AppPage);
			}
		}
		$this->redirect('page', 'listall');
	}
	
	/**
	 * Exibe as últimas 5 perguntas adicionadas a FAQ e um formulário para a adição de novas perguntas.
	 * 
	 * @return void
	 */
	public function faq() {
		$AppPage = AppPageFactory::getInstance();
		$pages = $AppPage->getAll(true);
		$faq_pages = $pages->findByCallbackMethod('ownFAQ', array());
		$data = array();
		$limit = 5;
		
		for($i = 0; $i < count($faq_pages) && $limit > 0; $i++) {
			$collection = $faq_pages[$i]->getFAQ();
			$faq_elements = $collection->getEntries();
			$data[$i] = array();
			
			foreach ($faq_elements as $faqElement) {
				if ( $limit > 0) {
					array_push($data[$i], $faqElement->getData());
					$limit++;
				}
			}
		}
		
		$this->set('faq', $data);
	}
	
	/**
	 * Adiciona uma pergunta a FAQ de uma página.
	 * 
	 * @return void
	 */
	public function addFAQ() {
		$question = Validation::setVar('question', 'post');
		$response = Validation::setVar('response', 'post');
		$page = Validation::setVar('page', 'post');
			
		if ( isset($question[1]) && isset($response[1]) && isset($page[0])) {
			
			/** Recupera dados da página **/
			$AppPage = AppPageFactory::getInstance();
			$AppPage->setData( array('id' => $page));
			if ( $AppPage->retrievesData() ) {
				
				/** Cria o FAQElement e o adiciona a coleção de perguntas e respostas da página selecionada **/
				$FAQElement = FAQElementFactory::getInstance();
				$FAQElement->setData( array('question' => $question, 'response' => $response, 'page' => $page));
				
				// Adiciona o FAQElement na AppPage
				$AppPage->addFAQElement($FAQElement);
				
				if ( $AppPage->saveFAQ()) {
					$message = 'Pergunta adicionada com sucesso.';
				}
				else {
					$message = 'Erro ao adicionar pergunta.';
				}
			}
			else {
				$message = 'A página selecionada não existe.';
			}
		}
		else {
			$message = 'Erro ao adicionar pergunta.';
		}
		$this->setMessage($message);
		$this->redirect('page', 'faq');
	}
	
	/**
	 * Remove um FAQElement da coleção de perguntas e resposats da página.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function removeFAQ($data) {
		if ( is_array($data) && is_numeric($data[0]) && is_numeric($data[1])) {
			
			/** REMOVE A PERGUNTA DA PÁGINA **/
			$AppPage = AppPageFactory::getInstance();
			$AppPage->setData( array('id' => $data[1]) );
			$AppPage->retrievesData();
			if( $AppPage->removeFAQElement( (int) $data[0]) ) {
				if ( $AppPage->saveFAQ()) {
					$this->setMessage('Pergunta removida com sucesso.');
				}
				else {
					$this->setMessage('Erro ao remover pergunta.');
				}	
			}
			else {
				$this->setMessage('Erro ao remover pergunta.');
			}
		}
		else {
			$this->setMessage('Erro ao excluir pergunta');
		}
		$this->redirect('page', 'faq');
	}
	
	/**
	 * Lista todas as perguntas frequentes cadastradas no sistema.
	 * 
	 * @return void
	 */
	public function listFAQ() {
		$AppPage = AppPageFactory::getInstance();
		$pages = $AppPage->getAll(true);
		$faq_pages = $pages->findByCallbackMethod('ownFAQ', array());
		$data = array();
		
		foreach ($faq_pages as $faq_page) {
			$collection = $faq_page->getFAQ();
			$collection = $collection->getCollection();
			$iterator = $collection->getIterator();
			
			while ( $iterator->valid() ) {
				$faq_element = $iterator->current();
				array_push($data, $faq_element->getData());
				$iterator->next();
			}
			unset($collection);
			unset($iterator);
		}
		$this->set('pages', $data);
	}
}
