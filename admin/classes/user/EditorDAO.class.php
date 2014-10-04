<?php
VFAutoload::load('UserDAO', 'user');

/**
 * Classe DAO de um Editor.
 * Esta classe será responsável por gerênciar a comunicação de um Editor como banco de dados.
 * Através desta classe seram feitas todas as requisições, obtenções, inserções e alterações de dados no banco de dados.
 *
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user
 */
class EditorDAO extends UserDAO {
	/**
	 * Construtor da classe
	 * 
	 * @see UserDAO::__construct($type)
	 */
	public function __construct() {
		parent::__construct('Editor');
	}
}
