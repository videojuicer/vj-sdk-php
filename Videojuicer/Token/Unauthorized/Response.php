<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_Token_Unauthorized");

class Videojuicer_Token_Unauthorized_Response extends Videojuicer_Response {
	
	/**
	 * Create a token object from the data
	 */ 
	public function __construct($data) {
		parent::__construct($data);
		
		$unauthorized_token = new Videojuicer_Token_Unauthorized($data);
		Videojuicer::set_request_token($unauthorized_token);
	}

}
?>