<?php
/**
 * Interface padrão de página.
 * Esta interface servirá todas as páginas do site.
 * 
 * @author Pi Digital
 * @package view
 */
interface PageInterface {
	/**
	 * Renderiza a página atual.
	 * 
	 * @param PDAction $Module
	 * @throws ViewNotFoundException
	 * @return boolean
	 */
	public function render($Module);
	
	/**
	 * Seta a view que será usada na página.
	 * 
	 * @param string $view
	 * @return void
	 */
	public function setView($view);
	
	/**
	 * Seta o header da página.
	 * 
	 * @param string $header
	 * @return void
	 */
	public function setHeader($header);
	
	/**
	 * Seta o footer da página.
	 * 
	 * @param string $footer
	 * @return void
	 */
	public function setFooter($footer);
	
	/**
	 * Seta a sidebar de uma página.
	 * 
	 * @param string $sidebar
	 * @return void
	 */
	public function setSidebar($sidebar);
	
	/**
	 * Retorna o header da página.
	 * 
	 * @param boolean $echo
	 * @return string
	 */
	public function getHeader($echo = true);
	
	/**
	 * Retorna o footer da página
	 * 
	 * @param boolean $echo
	 * @return string
	 */
	public function getFooter($echo = true);
	
	/**
	 * Retorna a sidebar de uma página.
	 * 
	 * @param boolean $echo
	 * @return string
	 */
	public function getSidebar($echo = true);
	
}
