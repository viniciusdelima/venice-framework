<?php
PDAutoload::load('DAOInterface', 'object');
PDAutoload::load('AppPageExistsException', 'app.exceptions');
/**
 * Classe DAO para a entidade AppPage.
 * 
 * @author Pi Digital
 * @package app
 */
class AppPageDAO implements DAOInterface {
	/**
	 * Insere uma página no banco de dados.
	 *
	 * @param AppPage $AppPage
	 * @throws AppPageExistsException
	 * @return boolean
	 */
	public function insert($AppPage) {
		if ($AppPage instanceof AppPage) {
			if ( !$this->exists($AppPage)) {
				$query = 'INSERT INTO pd_pages SET page_author = ?, page_title=?, page_content=?, page_active=?, page_register_date=?';
				$info = $AppPage->getData();
				$data = array( Validation::antiInjection($info['author']), Validation::antiInjection($info['title']), Validation::antiInjection($info['content']), Validation::antiInjection($info['active']), time());
				try {
					$DB = DBFactory::getInstance();
					if ( $DB->query($query, $data)) {
						return true;
					}
					return false;
				}
				catch (PDException $e) {
					return false;
				}
			}
			else {
				throw new AppPageExistsException();
			}
		}
		return false;
	}
	
	/**
	 * Atualiza dados no banco de dados.
	 *
	 * @param AppPage $AppPage
	 * @return boolean
	*/
	public function update($AppPage) {
		if ( $AppPage instanceof AppPage) {
			$query = 'UPDATE pd_pages SET page_author =?, page_title=?, page_content=?, page_active=?, page_register_date=? WHERE page_id=?';
			$data = ArrayHelper::convertsToNumericKeys( $AppPage->getData());
			$id = $data[0];
			unset($data[0]);
			array_push($data, $id);
			$data = ArrayHelper::arrangeArray($data);
			$data = ArrayHelper::escapeArray($data);
			
			try {
				$DB = DBFactory::getInstance();
				if ( $DB->query($query, $data)) {
					return true;
				}
				return false;
			}
			catch (DBException $e) {
				return false;
			}
		}
		return false;
	}
	
	/**
	 * Remove dados do banco de dados.
	 *
	 * @param AppPage $AppPage
	 * @return boolean
	*/
	public function delete($AppPage) {
		if ( $AppPage instanceof AppPage) {
			$query = 'DELETE FROM pd_pages WHERE page_id=?';
			$data = array( Validation::antiInjection( $AppPage->propertyReturns('id')));
			$DB = DBFactory::getInstance();
			return $DB->query($query, $data);
		}
	}
	
	/**
	 * Recupera os dados do banco de dados.
	 *
	 * @param AppPage $AppPage
	 * @return array
	*/
	public function get($AppPage) {
		$query = 'SELECT * FROM pd_pages WHERE page_id=? OR page_title=?';
		$data = array( Validation::antiInjection( $AppPage->propertyReturns('id')), Validation::antiInjection( $AppPage->propertyReturns('title')));
		$DB = DBFactory::getInstance();
		$page = $DB->get($query, $data);
		return $page;
	}
	
	/**
	 * Verifica se a Página exista no banco de dados.
	 * 
	 * @param AppPage $AppPage
	 * @return boolean
	 */
	public function exists($AppPage) {
		if ($AppPage instanceof AppPage) {
			$data = array( Validation::antiInjection( $AppPage->propertyReturns('title')), Validation::antiInjection( $AppPage->propertyReturns('id')));
			$query = 'SELECT COUNT(*) FROM pd_pages WHERE page_title=? OR page_id=?';
			try {
				$DB = DBFactory::getInstance();
				$count = $DB->get($query, $data);
				return $count[0][0] > 0;
			}
			catch ( PDException $e) {
				return false;
			}
		}
		return false;
	}
	
	/**
	 * Retorna um array contendo todas as páginas salvas no banco de dados.
	 * 
	 * @return array
	 */
	public function getAll() {
		$query = 'SELECT pd_pages.*, pd_admin_users.* FROM pd_pages INNER JOIN pd_admin_users ON pd_admin_users.admin_id = pd_pages.page_author ORDER BY pd_pages.page_id';
		$DB = DBFactory::getInstance();
		$pages = $DB->get($query);
		return $pages;
	}
}
