<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_Presentation");

class Videojuicer_Oembed_Presentation_Response extends Videojuicer_Response {
	
	private $html;
	
	/**
	 * Parse the xml
	 */ 
	public function __construct($xml) {
		$xml = simplexml_load_string($xml);
		
		parent::__construct($xml);
		
		$this->html = $xml->html;
	}
	
	
	/**
	 * Get the oembed code for the provided presentation
	 *
	 * @return string
	 */
	public function html() {
		return $this->html;
	}
	
}
?>