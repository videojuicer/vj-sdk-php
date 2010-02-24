<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_Token_Authorized");

class Videojuicer_Token_Authorized_Response extends Videojuicer_Response {
	
	/**
	 * Create a token object from the data
	 */ 
	public function __construct($data) {
		parent::__construct($data);
		
		$authorized_token = new Videojuicer_Token_Authorized($data);
		Videojuicer::set_access_token($authorized_token);
	}

}
?>