<?php
Videojuicer_ClassLoader::load("Videojuicer_Response");
Videojuicer_ClassLoader::load("Videojuicer_User_List");

class Videojuicer_User_List_Response extends Videojuicer_Response {
	
	private $users;
	
	/**
	 * Create the presentation list from the resulting xml
	 */ 
	public function __construct($xml) {
		$xml = simplexml_load_string($xml);
		
		parent::__construct($xml);
		
		$list = new Videojuicer_User_List();
		
		$items = $xml->items->user;
		
		foreach ($items as $item) {
			$obj = new Videojuicer_User($item);
			$list->add($obj);
		}
		
		$this->users = $list;
	}
	
	
	/**
	 * Get the users found
	 *
	 * @return Videojuicer_User_List
	 */
	public function users() {
		return $this->users;
	}
	
}
?>