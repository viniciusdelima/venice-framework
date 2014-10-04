<?php
/**
 * Esta classe tê por objetivo representar um campo de formulário.
 * Esta classe servirá de base para o gerênciamento dos campos dos formulários de cadastro e contato no sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package form
 */
class Field {
	/**
	 * Tipo de formulário para o qual o campo pertence.
	 * @name formType
	 * @access protected
	 * @var string
	 */
	protected $formType;
	
	/**
	 * Dados do campo
	 * @name $data
	 * @access protected
	 * @var array
	 */
	protected $data = array('id' => '', 'name' => '', 'type' => 'text', 'description' => '', 'mandatory' => 0, 'visibility' => 0);
	
	/**
	 * Classe DAO do Field
	 * @name FieldDAO
	 * @access protected
	 * @var Object
	 */
	protected $dao;
	
	/**
	 * Construtor da classe
	 *
	 * @param FieldDAO $dao
	 * @param string $formType
	 * @param array $data
	 * @return void 
	 */
	public function __construct($dao, $formType, $data = array()) {
		$this->dao = &$dao;
		$this->formType = $formType;
		$this->data = ArrayHelper::mergeEqualKeys($this->data, $data);
	}
	
	/**
	 * Seta os dados do campo.
	 * 
	 * @param array $data
	 * @return void
	 */
	public function setData(array $data) {
		$this->data = $data;
	} 
	
	/**
	 * Retorna os dados do campo.
	 * 
	 * @return string
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Adiciona um valor ao array de dados do campo.
	 * 
	 * @param string $key
	 * @param array $value
	 * @return void
	 */
	public function addPropertie($key, $value) {
		key_exists($key, $this->data) ? $this->data[$key] = $value : $key;
	}
	
	/**
	 * Retorna uma propriedade do campo
	 * 
	 * @param string $key
	 * @return string | int | boolean
	 */
	public function getPropertie($key) {
		if ( key_exists($key, $this->data)) {
			return $this->data[$key];
		}
	}
	
	/**
	 * Cadastra o campo no banco de dados.
	 * 
	 * @throws InvalidTypeField
	 * @return boolean
	 */
	public function register() {
		if ( in_array($this->formType, array('register', 'contact'))) {
			$pointer = &$this;
			if ( $this->dao->insert($pointer)) {
				return true;
			}
			return false;
		}
		throw new InvalidTypeFieldException();
		return false;
	}
	
	/**
	 * Retorna um array de campos salvos no banco de dados.
	 * 
	 * @return array
	 */
	public function getAll() {
		if ( in_array($this->formType, array('register', 'contact'))) {
			$pointer = &$this;
			return $this->dao->getAll($pointer);
		}
		throw new InvalidTypeFieldException();
		return false;
	}
	
	/**
	 * Recupera os dados do campo salvos no banco.
	 * 
	 * @return boolean
	 */
	public function retrievesData() {
		if ( !empty($this->data['id']) && is_numeric($this->data['id'])) {
			$pointer = &$this;
			$data = $this->dao->get($pointer);
			
			if ( count($data) > 0) {
				$this->setData( array('id' => $data[0]['field_id'], 'name' => $data[0]['field_name'], 
						'type' => $data[0]['field_type'], 'text' => $data[0]['field_text'], 
						'description' => $data[0]['field_description'], 'mandatory' => $data[0]['field_mandatory'], 'visibility' => $data[0]['field_active']));
				return true;
			}
			return false;
		}
		return false;
	}
	
	/**
	 * Atualiza os dados do campo no banco de dados.
	 * 
	 * @return boolean
	 */
	public function update() {
		$pointer = &$this;
		$result = $this->dao->update($pointer);
		return $result;
	}
	
	/**
	 * Este método exibe o campo formatado como um campo real em html
	 * 
	 * @param array $options
	 * @return string
	 */
	public function getFormattedField($options = array()) {
		if ( $this->data['type'] == 'message') {
			$str = '<textarea name="' . $this->data['name'] . '"';
		}
		else {
			$str = '<input type="' . $this->data['type'] . '" name="' . $this->data['name'] . '"';
		}
		
		foreach ($options as $option) {
			$str .= ' ' . $option;
		}
		
		if ( $this->data['type'] == 'message') {
			$str .= '> </textarea>';
		}
		else {
			$str .= '>';
		}
		return $str;
	}
}
