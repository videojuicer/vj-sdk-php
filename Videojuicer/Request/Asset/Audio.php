<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Permission");
Videojuicer_ClassLoader::load("Videojuicer_Request_Asset");

class Videojuicer_Request_Asset_Audio extends Videojuicer_Request_Asset {
	
	
	private static $asset_type = "audio";
	

	
	public static function find($id) {
		return parent::find(self::$asset_type, $id);
	}
	
	
	

	public static function find_all($criteria = array()) {
		return parent::find_all(self::$asset_type, $criteria);
	}
	
	

	public static function create($criteria = array(), $token_value, $token_secret) {
		return parent::create(self::$asset_type, $criteria, $token_value, $token_secret);
	}
	
}
?>