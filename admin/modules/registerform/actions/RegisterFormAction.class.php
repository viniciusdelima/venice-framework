<?php
VFAutoload::load('FieldFactory', 'form');
VFAutoload::loadModule('Basis');

/**
 * Módulo de controle dos formulários de cadastro.
 * Este módulo será responsável por gerênciar os formulários de cadastro.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package registerform
 */
class RegisterFormAction extends BasisAction {
	/**
	 * Página de início do gerênciamento dos formulários de cadastro.
	 * 
	 * @return void
	 */
	public function index() {
		$this->set('fields', $this->getAll());
	}
	
	/**
	 * Adiciona um campo ao formulário de cadastro.
	 * 
	 * @return void
	 */
	public function add() {
		global $User;
		$name        = Validation::setVar('name', 'post');
		$type        = Validation::setVar('type', 'post');
		$description = Validation::setVar('description', 'post');
		$mandatory   = Validation::setVar('mandatory', 'post');
		$active      = Validation::setVar('active', 'post');
		
		/** Atualiza formata os campos dos checkboxes para 0 ou 1, que enviaram a resposta como on e '' **/
		$mandatory == 'on' ? $mandatory = 1 : $mandatory = 0;
		$active    == 'on' ? $active    = 1 : $active    = 0;
		
		/** Cria o campo a ser adicionado ao formulário de cadastro **/
		$Field = FieldFactory::getInstance( array('name' => $name, 'type' => $type, 'description' => $description, 'mandatory' => $mandatory, 'visibility' => $active), 'register');
		
		if ( $User->addField($Field)) {
			$this->setMessage('Campo adicionado com sucesso.');
			$this->redirect('registerform');
		}
		else {
			$this->setMessage('Erro ao cadastrar campo.');
			$this->redirect('registerform');
		}
	}
	
	/**
	 * Exibe todos os campos do formulário de cadastro que estão salvos no banco de dados.
	 * 
	 * @return void
	 */
	public function getAll() {
		global $User;
		if ( $User->isLogged()) {
			$fields = $User->getAllFields( FieldFactory::getInstance( array('type' => 'text'), 'register'));
			
			/** PERCORRE O ARRAY DE CAMPOS INSERINDO UM ELEMENTO ADICIONAL CONTENDO O HTML DO CAMPO **/
			foreach ($fields as $key => $field) {
				$data = array(
						'id'          => $field['field_id'],
						'name'        => $field['field_name'],
						'type'        => $field['field_type'],
						'description' => $field['field_description'],
						'mandatory'   => $field['field_mandatory'],
						'visibility'  => $field['field_active']	
					);
				$FieldObject = FieldFactory::getInstance( array(), 'registerform');
				$FieldObject->setData($data);
				$fields[$key]['field_html'] = $FieldObject->getFormattedField();
			}
			
			return $fields;
		}
	}
	
	/**
	 * Atualiza um campo do formulário de cadastro.
	 * 
	 * @param array $params
	 * @return void
	 */
	public function update($params) {
		$id         = Validation::antiInjection($params[0]);
		$visibility = Validation::antiInjection($params[1]);
		$Field      = FieldFactory::getInstance(null, 'register');
		$Field->addPropertie('id', $id);
		
		if ( $Field->retrievesData()) {
			$Field->addPropertie('visibility', $visibility);
			
			if ( $User->updateForm($Field)) {
				$this->setMessage('Formulário atualizado com sucesso.');
			}
			else {
				$this->setMessage('Erro ao atualizar formulário de cadastro.');
			}
		}
		else {
			$this->setMessage('Não foi possível recuperar os dados do campo.');
		}
		$this->redirect('registerform');
	}
}
