<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");

class Videojuicer_Presentation_Delete_Response extends Videojuicer_Response {
	
	/**
	 * Process the result
	 */ 
	public function __construct($xml) {
		
		echo "The result is:";
		print_r($xml);
		
	}
	
}
?>