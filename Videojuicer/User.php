<?php
Videojuicer_ClassLoader::load("Videojuicer_Entity");

/**
 * Holds a Presentation dataset
 *
 */
class Videojuicer_User extends Videojuicer_Entity {
	
	private $id;
	private $created_at;
	private $updated_at;
	private $login;
	private $email;
	private $name;
	private $roles;

	
	public function __construct($data) {
		
		$this->id 				= (string) $data->id;
		$this->created_at		= (string) $data->created_at;
		$this->updated_at 		= (string) $data->updated_at;
		$this->login			= (string) $data->login;
		$this->email			= (string) $data->email;
		$this->name				= (string) $data->name;
		$this->roles			= (string) $data->roles;
	}
	
	
	
	
	public function get_id() {
		return $this->id;
	}
	
	public function get_created_at() {
		return $this->created_at;
	}
	
	public function get_updated_at() {
		return $this->updated_at;
	}
	
	public function get_login() {
		return $this->login;
	}
	
	public function get_email() {
		return $this->email;
	}
	
	public function get_name() {
		return $this->name;
	}
	
	public function get_roles() {
		return $this->roles;
	}
}
?>