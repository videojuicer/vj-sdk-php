<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");

class Videojuicer_Asset_Audio_Response extends Videojuicer_Response {
	
	/**
	 * Create the presentation list from the resulting xml
	 */ 
	public function __construct($xml) {
		parent::__construct($xml);
		
		print_r($xml);
	}

	
}
?>