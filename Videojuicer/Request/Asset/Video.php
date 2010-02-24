<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Permission");
Videojuicer_ClassLoader::load("Videojuicer_Request_Asset");

class Videojuicer_Request_Asset_Video extends Videojuicer_Request_Asset {
	
	private static $asset_type = "video";
	

	
	public static function find($id) {
		return parent::find(self::$asset_type, $id);
	}
	
	
	

	public static function find_all($criteria = array()) {
		return parent::find_all(self::$asset_type, $criteria);
	}
	

	public static function create($criteria = array(), $token_value, $token_secret) {
		return parent::create(self::$asset_type, $criteria, $token_value, $token_secret);
	}

	public static function update($id, $criteria = array(), $token_value, $token_secret) {
		return parent::update(self::$asset_type, $id, $criteria, $token_value, $token_secret);
	}

}
?>