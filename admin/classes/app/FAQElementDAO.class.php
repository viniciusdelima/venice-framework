<?php
PDAutoload::load('DAOInterface', 'object');
/**
 * Classe DAO para a FAQ.
 * Através desta classe serão feitas as operações na tabela encarregada de armazenar as perguntas e respostas da FAQ.
 * 
 * @author Pi Digital
 * @package app
 */
class FAQElementDAO implements DAOInterface {
	/**
	 * Insere os dados no banco de dados.
	 * 
	 * @param FAQ $FAQ
	 * @return boolean
	 */
	public function insert($FAQ) {
		$query = 'INSERT INTO pd_faq SET page_id=?, asking_text=?, asking_response=?';
		$waiting = $FAQ->getWaiting();
		$DB = DBFactory::getInstance();
		for ($i = 0; $i < count($waiting); $i++) {
			$data[0] = Validation::antiInjection($waiting[$i]['page']);
			$data[1] = Validation::antiInjection($waiting[$i]['question']);
			$data[2] = Validation::antiInjection($waiting[$i]['response']);
			
			if ( !$DB->query($query, $data)) {
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Atualiza os dados no banco de dados.
	 * 
	 * @param FAQ $FAQ
	 * @return boolean
	 */
	public function update($FAQ) {
		
	}
	
	/**
	 * Remove os dados do banco de dados.
	 * 
	 * @param FAQElement $FAQElement
	 * @return boolean
	 */
	public function delete($FAQElement) {
		if ($FAQElement instanceof FAQElement) {
			$waiting = $FAQElement->getWaiting();
			$params = array( Validation::antiInjection( (int)$waiting[0]['id']));
			
			if ($params[0] > 0) {
				$query = 'DELETE FROM pd_faq WHERE asking_id=?';
				$DB = DBFactory::getInstance();
				return $DB->query($query, $params);
			}
			return false;
		}
		return false;
	}
	
	/**
	 * Retorna os dados do banco de dados.
	 * 
	 * @param FAQ $FAQ
	 * @return array
	 */
	public function get($FAQ) {
		if ($FAQ instanceof FAQElement) {
			$query = 'SELECT * FROM pd_faq WHERE faq_id=?';
			$data = $FAQ->getData();
			$params = array( Validation::antiInjection( $data['id']));
			$DB = DBFactory::getInstance();
			$result = $DB->get($query, $params);
			return $result;
		}
	}
	
	/**
	 * Retorna um array contendo todas as perguntas salvas no banco de dados.
	 * 
	 * @return array
	 */
	public function getAll() {
		$query = 'SELECT pd_faq.*, pd_pages.* FROM pd_faq INNER JOIN pd_pages ON faq_page_id = page_id ORDER BY page_id';
		$DB = DBFactory::getInstance();
		$data = $DB->get($query);
		return $data;
	}
	
	/**
	 * Retorna um array contendo todas as perguntas de uma determinada página.
	 * 
	 * @param int $page
	 * @return array
	 */
	public function getAllFromPage($page) {
		if ( is_numeric($page)) {
			$page = array( Validation::antiInjection($page));
			$query = 'SELECT * FROM pd_faq WHERE page_id=?';
			$DB = DBFactory::getInstance();
			$data = $DB->get($query, $page);
			return $data;
		}
	}
}
