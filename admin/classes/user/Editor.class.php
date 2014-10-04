<?php
VFAutoload::load('User', 'user');
VFAutoload::load('EditorInterface', 'user');

/**
 * Classe para representar um Editor.
 * 
 * @author Vinicius C. de Lima <vinicius.c.lima03@gmail.com>
 * @package user
 */
class Editor extends User implements EditorInterface {
	/**
	 * Construtor da classe, inicia a classe e seta o endereço na memória de sua respectiva classe DAO
	 *
	 * @param EditorDAO $dao
	 * @see User::__construct($dao, $data = array())
	 * @return void
	 */
	public function __construct(EditorDAO $dao, $data = array()) {
		parent::__construct($dao, $data);
	}
	
	/**
	 * Sobre-escreve o método register
	 * 
	 * @see User::register($data = array())
	 */
	public function register($data = array()) {
		
	}
}
