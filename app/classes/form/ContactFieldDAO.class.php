<?php
/**
 * Classe DAO usada na atualização de campos dos formulários pelo painel do Administrador.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package form
 */
class ContactFieldDAO implements DAOInterface {
	/**
	 * Cadastra um campo na no banco de dados.
	 * 
	 * @see DAOInterface::insert($Object)
	 */
	public function insert($Field) {
		if ($Field instanceof Field) {
			$data = $Field->getData();
			unset($data['id']);
			
			try {
				$DB = DBFactory::getInstance();
				$query = 'INSERT INTO pd_contact_fields SET field_name=?, field_type=?, field_description=?, field_mandatory=?, field_active=?';
				$new = array();
				$i = 0;
				
				/** Limpa os parâmetros para evitar sql_injection **/
				foreach ($data as $k) {
					$new[$i] = Validation::antiInjection($k);
					$i++;
				}
				
				/** Realiza a consulta no banco de dados **/
				if ( $DB->query($query, $new)) {
					return true;
				}
				return false;
			}
			catch (DBException $e) {
				throw new DBException(1, $e->getErrorMessage());
				return false;
			}
			catch (Exception $e) {
				return false;
			}
		}
		return false;
	}
	
	/**
	 * Atualiza um campo no banco de dados.
	 * 
	 * @see DAOInterface::update($Object)
	 */
	public function update($Field) {
		if ($Field instanceof Field) {
			$data = $Field->getData();
			$data = array($data['name'], $data['type'], $data['description'], $data['mandatory'], $data['visibility'], $data['id']);
			
			try {
				$DB = DBFactory::getInstance();
				$query = "UVFATE pd_contact_fields SET field_name=?, field_type=?, field_description=?, field_mandatory=?, field_active=? WHERE field_id=?";
				
				/** Limpa os parâmetros para evitar sql_injection **/
				foreach ($data as $k => $i) {
					$data[$k] = Validation::antiInjection($i);
				}
				
				/** Realiza a consulta no banco de dados **/
				if ( $DB->query($query, $data)) {
					return true;
				}
				return false;
			}
			catch (DBException $e) {
				return false;
			}
			catch (Exception $e) {
				return false;
			}
		}
		// Objeto passado no parâmetro não é um campo
		return false;
	}
	
	/**
	 * Deleta um campo do banco de dados.
	 * 
	 * @see DAOInterface::delete($Object)
	 */
	public function delete($Field) {
		
	}
	
	/**
	 * Recupera um campo do banco de dados.
	 * 
	 * @see DAOInterface::get($Object)
	 */
	public function get($Field) {
		$id = Validation::antiInjection($Field->getPropertie('id'));
		try {
			$DB = DBFactory::getInstance();
			$data = $DB->get('SELECT * FROM pd_contact_fields WHERE field_id=?', array($id));
			return $data;
		}
		catch (DBException $e) {
			throw $e;
		}
	}
	
	/**
	 * Recupera os dados de todos campos usados no formulário de cadastro.
	 * 
	 * @param Field $Field
	 * @return array
	 */
	public function getAll($Field) {
		if ($Field instanceof Field) {
			try {
				$DB = DBFactory::getInstance();			
				$query = 'SELECT * FROM pd_contact_fields';
				$fields = $DB->get($query);
				return $fields;
			}
			catch (DBException $e) {
				throw $e;
			}
			catch (VFException $e) {
				throw $e;
			}
		}
	}
}
