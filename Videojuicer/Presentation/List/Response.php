<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_Presentation_List");

class Videojuicer_Presentation_List_Response extends Videojuicer_Response {
	
	private $presentations;
	
	/**
	 * Create the presentation list from the resulting xml
	 */ 
	public function __construct($xml) {
		$xml = simplexml_load_string($xml);
		
		parent::__construct($xml);
		
		$presentations = new Videojuicer_Presentation_List();
		
		$items = $xml->items->presentation;
		
		foreach ($items as $item) {
			$presentation = new Videojuicer_Presentation($item);
			$presentations->add($presentation);
		}
		
		$this->presentations = $presentations;
	}
	
	
	/**
	 * Get the presentations found
	 *
	 * @return Videojuicer_Presentation_List
	 */
	public function presentations() {
		return $this->presentations;
	}
	
}
?>