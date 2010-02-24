<?php
Videojuicer_ClassLoader::load("Videojuicer_Presentation");
Videojuicer_ClassLoader::load("Videojuicer_Entity_List");

class Videojuicer_Presentation_List extends Videojuicer_Entity_List {

	
	/**
	 * Construct the List with some presentations in it, optional
	 *
	 * @param array $presentations List of Videojuicer_Presentation objects
	 */
    public function __construct($presentations = null) {
        if (is_array($presentations)) {
            $this->items = $presentations;
        }
    }


	
	/**
	 * Add a presentation to thye list
	 *
	 * @param Videojuicer_Presentation $p
	 */
	public function add(Videojuicer_Presentation $p) {
		$this->items[] = $p;
	}
	
}
?>