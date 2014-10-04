<?php
PDAutoload::load('AppPageInterface', 'app');
PDAutoload::load('FAQElementFactory', 'app');
PDAutoload::load('FAQElementCollection', 'app');
/**
 * Esta classe servirá de classe base para uma página de hotsite do sistema.
 * Esta é a página que é exibida para os usuários comuns que logam no hotsite.
 * 
 * @author Pi Digital
 * @package app
 */
class AppPage implements AppPageInterface {
	/**
	 * Dados da página que estão salvos no banco de dados
	 * @name $data
	 * @access protected
	 * @var array
	 */
	protected $data = array('id' => '', 'author' => '', 'title' => '', 'content' => '', 'active' => '', 'register_date' => '');
	
	/**
	 * FAQ opicional da página
	 * @name faq
	 * @access private
	 * @var FAQElementCollection
	 */
	protected $faq;
	
	/**
	 * Ponteiro para localização da classe DAO na memória.
	 * @name dao
	 * @access protected
	 * @var AppPageDAO
	 */
	protected $dao;
	
	/**
	 * Construtor da Página.
	 * 
	 * @param AppPageDAO $dao
	 * @return void
	 */
	public function __construct($dao) {
		$this->faq = new FAQElementCollection('FAQElement');
		$this->dao = $dao;
	}
	
	/**
	 * Insere a página no banco de dados.
	 * 
	 * @see AppPageInterface::insert($AppPage)
	 */
	public function insert($AppPage) {
		return $this->dao->insert($AppPage);
	}
	
	/**
	 * Atualiza uma página no banco de dados.
	 * 
	 * @see AppPageInterface::update($AppPage)
	 */
	public function update($AppPage) {
		return $this->dao->update($AppPage);
	}
	
	/**
	 * Deleta uma página do banco de dados.
	 * 
	 * @see AppPageInterface::delete($AppPage)
	 */
	public function delete() {
		$pointer = &$this;
		return $this->dao->delete($pointer);
	}
	
	/**
	 * Seta os dados da página.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function setData(array $data) {
		$this->data = ArrayHelper::mergeEqualKeys($this->data, $data);
	}
	
	/**
	 * Retorna os dados da página.
	 * 
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Retorna uma propriedade da página.
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public function propertyReturns($key) {
		if ( isset($this->data[$key])) {
			return $this->data[$key];
		}
	}
	
	/**
	 * Retorna um array contendo todas as páginas salvas no banco de dados.
	 * 
	 * @param boolean $collection
	 * @return array
	 */
	public function getAll($collection = false) {
		$pages = $this->dao->getAll();
		for ($i = 0; $i < count($pages); $i++) {
			$start = 0;
			$end = count($pages[$i]) - 1;
			
			for ($j = $start; $j < $end; $j++) {
				unset($pages[$i][$j]);
			}
		}
		
		if ($collection) {
			$AppPageCollection = new Collection('AppPage');
			foreach ($pages as $page) {
				$FAQCollection = new FAQElementCollection('FAQElement');
				$FAQ = FAQElementFactory::getInstance();
				$faq_elements = $FAQ->getAll($page['page_id']);
				
				if ( count($faq_elements) > 0) {
					foreach ($faq_elements as $faq_element) {
						$FAQElement = clone $FAQ;
						$FAQElement->setData( array('id' => $faq_element['asking_id'], 'page' => $faq_element['page_id'], 'question' => $faq_element['asking_text'], 'response' => $faq_element['asking_response']));
						$FAQCollection->push($FAQElement);
					}
				}
				$page = ArrayHelper::changeKeys( array('id', 'author', 'title', 'content', 'active', 'register_date'), $page);
				$AppPageObject = AppPageFactory::getInstance();
				$AppPageObject->setData($page);
				$AppPageObject->addFAQ($FAQCollection);
				$AppPageCollection->push($AppPageObject);
				unset($AppPageObject);
				unset($FAQ);
				unset($FAQCollection);
			}
			$pages = $AppPageCollection;
		}
		return $pages;
	}
	
	/**
	 * Recupera os dados da página.
	 * 
	 * @return boolean
	 */
	public function retrievesData() {
		if ( isset($this->data['id']) || isset($this->data['title'])) {
			$pointer = &$this;
			$data = $this->dao->get($pointer);
			if ( count($data) > 0) {
				$this->data = array(
							'id' => $data[0]['page_id'],
							'author' => $data[0]['page_author'],
							'title' => $data[0]['page_title'],
							'content' => $data[0]['page_content'],
							'active' => $data[0]['page_active'],
							'register_date' => $data[0]['page_register_date']
						);
				
				/** RECUPERA DADOS DE PERGUNTAS FREQUENTES VINCULADAS A PÁGINA **/
				$FAQCollection = new FAQElementCollection('FAQElement');
				$FAQ = FAQElementFactory::getInstance();
				$faq_elements = $FAQ->getAll($data[0]['page_id']);
				
				if ( count($faq_elements) > 0) {
					foreach ($faq_elements as $faq_element) {
						$FAQElement = clone $FAQ;
						$FAQElement->setData( array('id' => $faq_element['asking_id'], 'page' => $faq_element['page_id'], 'question' => $faq_element['asking_text'], 'response' => $faq_element['asking_response']));
						$FAQCollection->push($FAQElement);
					}
				}
				$this->faq = $FAQCollection;
				return true;
			}
			// Página não existe
			return false;
		}
		return false;
	}
	
	/**
	 * Seta uma propriedade individual do array de dados da página.
	 * 
	 * @param int | string $key
	 * @param mixed $value
	 * @return void
	 */
	public function setPropertie($key, $value) {
		if ( isset($this->data[$key])) {
			$this->data[$key] = $value;
		}
	}
	
	/**
	 * Verifica se a página existe cadastrada no banco de dados.
	 * 
	 * @return void
	 */
	public function exists() {
		$pointer = &$this;
		return $this->dao->exists($pointer);
	}
	
	/**
	 * Retorna a faq da página.
	 * 
	 * @return Collection
	 */
	public function getFAQ() {
		return $this->faq;
	}
	
	/**
	 * Verifica se a página possui uma FAQ.
	 * 
	 * @return boolean
	 */
	public function ownFAQ() {
		return $this->faq->getTotalElements() > 0;
	}
	
	/**
	 * Adiciona a faq da página caso a mesma a possua.
	 * 
	 * @param Collection $FAQ
	 * @return void
	 */
	public function addFAQ(Collection $FAQ) {
		$this->faq = $FAQ;
	}
	
	/**
	 * Adiciona um FAQElement a coleção de perguntas e respostas da página.
	 * 
	 * @param FAQElement $FAQElement
	 * @return void
	 */
	public function addFAQElement(FAQElement $FAQElement) {
		/** Seta no FAQElement os dados que deverão ser atualizados, inseridos ou removidos do banco de dados **/
		$FAQElement->set('insert');
		$this->faq->push($FAQElement);
	}
	
	/**
	 * Remove um FAQElement do array de FAQElements da AppPage.
	 * 
	 * @param int $id
	 * @return boolean
	 */
	public function removeFAQElement($id) {
		try {
			$FAQElement = $this->faq->getElementById($id);
			$FAQElement->set('delete');
			return true;
		}
		catch (FAQElementException $e) {
			return false;
		}
	}
	
	/**
	 * Atualiza o array de perguntas e respostas da página no banco de dados.
	 * 
	 * @return boolean
	 */
	public function saveFAQ() {
		$collection = $this->faq->getCollection();
		$iterator = $collection->getIterator();
		
		while ( $iterator->valid() ) {
			$element = $iterator->current();
			$element->save();
			$iterator->next();
		}
		return true;
	}
}
