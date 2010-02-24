<?php
Videojuicer_ClassLoader::load("Videojuicer_User");
Videojuicer_ClassLoader::load("Videojuicer_Entity_List");

class Videojuicer_User_List extends Videojuicer_Entity_List {

	
	/**
	 * Construct the List with some users in it (optional)
	 *
	 * @param array $users List of Videojuicer_User objects
	 */
    public function __construct($users = null) {
        if (is_array($users)) {
            $this->items = $users;
        }
    }


	
	/**
	 * Add a user to the list
	 *
	 * @param Videojuicer_User $p
	 */
	public function add(Videojuicer_Entity $p) {
		$this->items[] = $p;
	}
	
}
?>