<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_User");

class Videojuicer_User_Response extends Videojuicer_Response {
	
	private $user;
	
	/**
	 * Create the presentation list from the resulting xml
	 */ 
	public function __construct($xml) {
		$xml = simplexml_load_string($xml);
		
		parent::__construct($xml);
		
		$user = new Videojuicer_User($xml);
		$this->user = $user;
	}
	
	
	/**
	 * Get the user found
	 *
	 * @return Videojuicer_User
	 */
	public function user() {
		return $this->user;
	}
	
}
?>