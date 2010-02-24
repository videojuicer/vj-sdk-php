<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Permission");

class Videojuicer_Request_User {
	
	
	/**
	 * Get the user with the provided ID
	 *
	 * @param int $id
	 * @return Videojuicer_User_Response
	 */
	public static function find($id, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())

		$method = "users/$id";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_User_Response";
		$exception_class = "Videojuicer_User_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	

	/**
	 * Get all users matching the provided criteria
	 *
	 * @param int $id
	 * @return Videojuicer_User_List_Response
	 */
	public static function find_all($criteria = array(), $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())

		$method = "users";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_User_List_Response";
		$exception_class = "Videojuicer_User_List_Exception";
		$permission = Videojuicer_Permission::NONE;
		$attributes = Videojuicer_Request::wrap_vars($criteria, "user");
		
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		$request->set_vars($attributes);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	public static function create($attributes = array(), $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())

		$method = "users";
		$type = Videojuicer_Request::POST;
		$response_class = "Videojuicer_User_Create_Response";
		$exception_class = "Videojuicer_User_Create_Exception";
		$permission = Videojuicer_Permission::NONE;
		$attributes = Videojuicer_Request::wrap_vars($attributes, "user");
		
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		$request->set_vars($attributes);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	public static function update($id, $attributes, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "users/$id";
		$type = Videojuicer_Request::PUT;
		$response_class = "Videojuicer_User_Update_Response";
		$exception_class = "Videojuicer_User_Update_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;
		
		$attributes = Videojuicer_Request::wrap_vars($attributes, "user");
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		$request->set_authorized(true, $token_value, $token_secret);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	
	

	/**
	 * Delete the user with ID provided
	 *
	 * @param int $id
	 */
	public static function delete($id, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "users/$id";
		$type = Videojuicer_Request::DELETE;
		$response_class = "Videojuicer_User_Delete_Response";
		$exception_class = "Videojuicer_User_Delete_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;

		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		
		return Videojuicer::execute_call($request);
		
	}
		
	
	
	
	
	public static function add_role($id, $role, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "users/$id/add_role";
		$type = Videojuicer_Request::POST;
		$response_class = "Videojuicer_User_AddRole_Response";
		$exception_class = "Videojuicer_User_AddRole_Exception";
		$permission = Videojuicer_Permission::NONE;
		$attributes = array("role" => $role);
		
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		$request->set_vars($attributes);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	public static function remove_role($id, $role, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "users/$id/remove_role";
		$type = Videojuicer_Request::POST;
		$response_class = "Videojuicer_User_RemoveRole_Response";
		$exception_class = "Videojuicer_User_RemoveRole_Exception";
		$permission = Videojuicer_Permission::NONE;
		$attributes = array("role" => $role);
		
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		$request->set_vars($attributes);
		
		return Videojuicer::execute_call($request);
	}
}
?>