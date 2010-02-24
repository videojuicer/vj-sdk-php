<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");

class Videojuicer_Asset_Audio_Create_Response extends Videojuicer_Response {

	private $xml_object;
	/**
	 * Process the result
	 */ 
	public function __construct($xml) {
		$this->xml_object = simplexml_load_string($xml);
	}

	/**
	 * Return the result
	 */ 
	public function get_response() {
		return $this->xml_object;
	}
	
	
}
?>