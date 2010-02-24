<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Permission");
Videojuicer_ClassLoader::load("Videojuicer_Request_Asset");

class Videojuicer_Request_Asset_Document extends Videojuicer_Request_Asset {
	
	
	private static $asset_type = "document";
	
	/**
	 * Get the presentation with the provided ID
	 *
	 * @param int $id
	 * @return Videojuicer_Presentation_Response
	 */
	public static function find($id) {
		parent::find(self::$asset_type, $id);
	}
	
	
	
	/**
	 * Get all presentations, optinally meeting the required criteria
	 *
	 * @param array $criteria Find only presentations which meet the criteria provided
	 * @return Videojuicer_Presentation_List_Response
	 */
	public static function find_all($criteria = array()) {
		parent::find_all(self::$asset_type, $criteria);
	}
	

	public static function create($criteria = array(), $token_value, $token_secret) {
		return parent::create(self::$asset_type, $criteria, $token_value, $token_secret);
	}
	

}
?>