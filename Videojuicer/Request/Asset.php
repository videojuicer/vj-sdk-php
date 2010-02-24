<?php
abstract class Videojuicer_Request_Asset {
	
	/**
	 * Get the asset with the provided ID
	 *
	 * @param int $id
	 * @return Videojuicer_Response
	 */
	protected static function find($asset_type, $id) {

		$method = "assets/$asset_type/$id";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_Response";
		$exception_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		return Videojuicer::execute_call($request);
	}
	
	
	
	/**
	 * Get all assets, optinally meeting the required criteria
	 *
	 * @param array $criteria Find only presentations which meet the criteria provided
	 * @return Videojuicer_Presentation_List_Response
	 */
	protected static function find_all($asset_type, $criteria = array()) {

		$method = "assets/$asset_type";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_List_Response";
		$exception_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_List_Exception";
		$permission = Videojuicer_Permission::NONE;
		$attributes = Videojuicer_Request::wrap_vars($criteria, "asset");
		
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	
	protected static function create($asset_type, $attributes, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to rectrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		
		$method = "assets/$asset_type";
		$type = Videojuicer_Request::POST;
		$response_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_Create_Response";
		$exception_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_Create_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;
		
		if (isset($attributes["file"])) {
			$file = $attributes["file"];
			unset($attributes["file"]);
		}
		
		$attributes = Videojuicer_Request::wrap_vars($attributes, "asset");
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		$request->set_authorized(true, $token_value, $token_secret);
		$request->set_upload_file_path($file);
		
		return Videojuicer::execute_call($request);
	}

	/**
	 * Update the presentation with ID provided to the attributes provided
	 *
	 * @param int $id
	 * @param array $attributes
	 */
	public static function update($asset_type, $id, $attributes, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "assets/$asset_type/$id";
		$type = Videojuicer_Request::PUT;
		$response_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_Update_Response";
		$exception_class = "Videojuicer_Asset_" . ucfirst($asset_type) . "_Update_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;
		
		$attributes = Videojuicer_Request::wrap_vars($attributes, "asset");
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		$request->set_authorized(true, $token_value, $token_secret);
		
		return Videojuicer::execute_call($request);
		
	}
	
}
?>