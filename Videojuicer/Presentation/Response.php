<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_Presentation");

class Videojuicer_Presentation_Response extends Videojuicer_Response {
	
	private $presentation;
	
	/**
	 * Create the presentation list from the resulting xml
	 */ 
	public function __construct($xml) {
		$xml = simplexml_load_string($xml);
		
		parent::__construct($xml);
		
		$presentation = new Videojuicer_Presentation($xml);
		$this->presentation = $presentation;
	}
	
	
	/**
	 * Get the presentations found
	 *
	 * @return Videojuicer_Presentation
	 */
	public function presentation() {
		return $this->presentation;
	}
	
}
?>