<?php
abstract class Videojuicer_Asset {
	
	private $attributes = array();
	
	public function get_id() {
		return $this->attributes["id"];
	}
	
	
	public function get_user_id() {
		return $this->attributes["user_id"];
	}
	
	
	public function get_file() {
		return $this->attributes["file"];
	}
	
	
	public function get_file_name() {
		return $this->attributes["file_name"];
	}
	
	
	public function get_file_size() {
		return $this->attributes["file_size"];
	}
	
	
	public function get_state() {
		return $this->attributes["state"];
	}
	
	
	public function get_state_changed_at() {
		return $this->attributes["state_changed_at"];
	}
	
	
	public function get_state_changed_url() {
		return $this->attributes["state_changed_url"];
	}
	
	
	public function get_url() {
		return $this->attributes["url"];
	}
	
	
	public function get_licensed_by() {
		return $this->attributes["licensed_by"];
	}
	
	
	public function get_licensed_under() {
		return $this->attributes["licensed_under"];
	}
	
	
	public function get_published_at() {
		return $this->attributes["published_at"];
	}
	
	
	public function get_created_at() {
		return $this->attributes["created_at"];
	}
	
	public function get_updated_at() {
		return $this->attributes["updated_at"];
	}
}
?>