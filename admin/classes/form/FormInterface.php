<?php
/**
 * Interface de gerênciamento de formulários de cadastro dos usuários.
 * Esta interface provê métodos para a Administração de do formulário de cadastro usado pelos usuários do sistema.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package form
 */
interface FormInterface {
	/**
	 * Adiciona um campo ao formulário de cadastro dos usuários.
	 *
	 * @param Field $Field
	 * @return boolean
	 */
	public function addField(Field $Field);
	
	/**
	 * Remove um campo do formulário de cadastro.
	 * 
	 * @param Field $Field
	 * @return void
	 */
	public function removeField(Field $Field);
	
	/**
	 * Atualiza um campo do formulário de cadastro.
	 * 
	 * @param Field $Field
	 * @return void
	 */
	public function updateForm(Field $Field);
	
	/**
	 * Retorna um array contendo todos os campos do formulário de cadastro.
	 * 
	 * @param Field $Field
	 * @return array
	 */
	public function getAllFields(Field $Field);
}
