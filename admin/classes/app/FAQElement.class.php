<?php
PDAutoload::load('FAQElementInterface', 'app');
PDAutoload::load('FAQElementDAO', 'app');
PDAutoload::load('FAQElementException', 'app.exceptions');
/**
 * Esta classe têm por objetivo representar o elemento principal de uma FAQ composto por uma pergunta e uma resposta.
 * Esta classe não representa uma Página da visão do usuário (AppPage), trata-se apenas de uma Entidade
 * responsável por gerênciar as perguntas e respostas que serão atribuídas a uma determinada AppPage.
 * 
 * @author Pi Digital
 * @package app
 */
class FAQElement implements FAQElementInterface {
	
	/**
	 * Array de dados da entidade.
	 * @name data
	 * @access private
	 * @var array
	 */
	private $data = array('id' => '', 'question' => '', 'response' => '', 'page' => '');
	
	/**
	 * Dados aguardando para serem salvos no banco.
	 * @name waiting
	 * @access private
	 * @var array
	 */
	private $waiting = array();
	
	/**
	 * Action da classe DAO  ser chamada.
	 * @name operation
	 * @access private
	 * @var string
	 */
	private $operation = false;
	
	/**
	 * Entidade DAO da FAQ.
	 * @name dao
	 * @access private
	 * @var FAQDAO
	 */
	private $dao;
	
	/**
	 * Conrtutor da classe.
	 * 
	 * @param FAQDAO $dao
	 * @return void
	 */
	public function __construct($dao) {
		if ($dao instanceof FAQElementDAO) {
			$this->dao = $dao;
		}
	}
	
	/**
	 * Adiciona uma pergunta ao array de perguntas da FAQ.
	 * 
	 * @see FAQElementInterface::set($operation)
	 */
	public function set($operation) {
		$this->waiting[] = $this->data;
		$this->operation = $operation;
	}
	
	/**
	 * Remove uma pergunta ou mais do array de perguntas da faq.
	 * 
	 * @see FAQInterface::remove()
	 */
	public function remove() {
		if ( is_numeric($this->data['id'])) {
			$this->waiting[] = $this->data;
			$this->operation = 'delete';
			return true;
		}
		return false;
	}
	
	/**
	 * Atualiza uma pergunta do array de perguntas da FAQ.
	 * 
	 * @see FAInterface::update(array $data)
	 */
	public function update(array $data) {
		
	}
	
	/**
	 * Salva a FAQ no banco de dados.
	 * 
	 * @see FAQInterface::save()
	 */
	public function save() {
		if ( method_exists($this->dao, $this->operation) && false !== $this->operation) {
			$pointer = &$this;
			$method = $this->operation;
			$this->dao->$method($this);
			$this->operation = false;
			return true;
		}
		return false;
	}
	
	/**
	 * Verifica se a pergunta já existe no array de perguntas da FAQ.
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function exists() {
		
	}
	
	/**
	 * Recupera os dados do banco de dados.
	 * 
	 * @return void
	 */
	public function retrievesData() {
		$ponter = &$this;
		$data = $this->dao->get($pointer);
		
		if ( count($data) > 0) {
			$formatted_data = array('id' => $data['asking_id'], 'page' => $data['page_id'], 'question' => $data['askin_text'], 'response' => $data['asking_response']);
			$this->data = $formatted_data;
		}
	}
	
	/**
	 * Retorna os dados que setão esperando para serem salvos no banco de dados.
	 * 
	 * @return array
	 */
	public function getWaiting() {
		return $this->waiting;
	}
	
	/**
	 * Retorna um array contendo todas as perguntas do banco de dados.
	 * Caso o parâmetro $page seja passado, então será retornado todas as perguntas de uma determinada página
	 * 
	 * @param int $page
	 * @return array
	 */
	public function getAll($page = 0) {
		$page > 0 && is_numeric($page) ? $data = $this->dao->getAllFromPage($page) : $data = $this->dao->getAll();
		
		for ($i = 0; $i < count($data); $i++) {
			$start = 0;
			$end = count($data[$i]) - 1;
		
			for ($j = $start; $j < $end; $j++) {
				unset($data[$i][$j]);
			}
		}
		
		return $data;
	}
	
	/**
	 * Retorna uma pergunta do array de perguntas da FAQ.
	 * 
	 * @param int $id
	 * @return array
	 */
	public function getQuestion($id) {
		$data = array();
		foreach ($this->data as $k => $i) {
			if ( $this->data[$k]['id'] == $id) {
				$data = $this->data[$k];
			}
		}
		return $data;
	}
	
	/**
	 * Seta o array de perguntas da FAQ.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function setData($data) {
		if ( is_array($data)) {
			$this->data = $data;
		}
	}
	
	/**
	 * Retorna os dados do FAQElement.
	 * 
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Retorna um valor do array de dados do FAQElement.
	 * 
	 * @param string $key
	 * @return string | int | void
	 */
	public function getVal($key) {
		if ( isset($this->data[$key])) {
			return $this->data[$key];
		}
	}
}
