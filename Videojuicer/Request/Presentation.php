<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Permission");

class Videojuicer_Request_Presentation {
	
	
	/**
	 * Get the presentation with the provided ID
	 *
	 * @param int $id
	 * @param boolean $oembed Whether to make this call as an OEmbed request
	 * @param int $maxwidth The maximum width of the presentation if making an OEmbed request, if OEmbed this is mandatory
	 * @param int $maxheight The maximum height of the presentation if making an OEmbed request, if OEmbed this is mandatory
	 * @param string $oembed_format The format of the OEmbed response, by default is "xml" but also supports "json"
	 * 
	 * @return Videojuicer_Presentation_Response
	 */
	public static function find($id, $oembed = false, $maxwidth = null, $maxheight = null, $oembed_format = "xml", $embed_attributes = array(), $flashvar_attributes = array()) {

		$method = "presentations/$id";
		$type = Videojuicer_Request::GET;
		
		// Determine the response/exception based on whether it is an oembed call
		if ($oembed) {
			$response_class = "Videojuicer_Oembed_Presentation_Response";
			$exception_class = "Videojuicer_Oembed_Presentation_Exception";
		} else {
			$response_class = "Videojuicer_Presentation_Response";
			$exception_class = "Videojuicer_Presentation_Exception";
		}
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		if ($oembed) {
			$request->set_oembed(true, $maxwidth, $maxheight, $oembed_format, $embed_attributes, $flashvar_attributes);
		}
		return Videojuicer::execute_call($request);
	}
	
	
	
	/**
	 * Get all presentations, optinally meeting the required criteria
	 *
	 * @param array $criteria Find only presentations which meet the criteria provided
	 * @return Videojuicer_Presentation_List_Response
	 */
	public static function find_all($criteria = array()) {

		$method = "presentations";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Presentation_List_Response";
		$exception_class = "Videojuicer_Presentation_List_Exception";
		$permission = Videojuicer_Permission::NONE;
		$attributes = Videojuicer_Request::wrap_vars($criteria, "presentation");
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		
		return Videojuicer::execute_call($request);
	}
	
	
	
	/**
	 * Get all presentations which are related to the prsentation id provided based on tag matching.
	 * Optionally the resultset can be restricted by applying criteria
	 *
	 * @param int $id The id of the presentation we're relating to
	 * @param array $criteria Find only presentations which meet the criteria provided
	 * @return Videojuicer_Presentation_List_Response
	 */
	public static function find_all_related_to($id, $criteria = array()) {

		$method = "presentations/$id/related_by_tag";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Presentation_List_Response";
		$exception_class = "Videojuicer_Presentation_List_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		return Videojuicer::execute_call($request);
	}
	
	
	
	/**
	 * Create a presentation with the attributes provided
	 *
	 * @param array $attributes
	 */
	public static function create($attributes, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to rectrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		//echo $token_value;
		//echo  $token_secret;
		
		$method = "presentations";
		$type = Videojuicer_Request::POST;
		$response_class = "Videojuicer_Presentation_Create_Response";
		$exception_class = "Videojuicer_Presentation_Create_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;
		//print_r($attributes);
		$attributes = Videojuicer_Request::wrap_vars($attributes, "presentation");
		//print_r($attributes);
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		$request->set_authorized(true, $token_value, $token_secret);
		
		$a = Videojuicer::execute_call($request);
		
		//print_r($attributes);
		
		return $a;
		
		//return Videojuicer::execute_call($request);
	}
	
	
	
	
	
	/**
	 * Update the presentation with ID provided to the attributes provided
	 *
	 * @param int $id
	 * @param array $attributes
	 */
	public static function update($id, $attributes, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "presentations/$id";
		$type = Videojuicer_Request::PUT;
		$response_class = "Videojuicer_Presentation_Update_Response";
		$exception_class = "Videojuicer_Presentation_Update_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;
		
		$attributes = Videojuicer_Request::wrap_vars($attributes, "presentation");
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_vars($attributes);
		$request->set_authorized(true, $token_value, $token_secret);
		
		return Videojuicer::execute_call($request);
		
	}
	
	

	/**
	 * Update the presentation with ID provided to the attributes provided
	 *
	 * @param int $id
	 * @param array $attributes
	 */
	public static function delete($id, $token_value, $token_secret) {
		
		#TODO: Check if token value/secret is null and if so try to retrieve from VJ  (Videojuicer::get_access_token()->get_token(), Videojuicer::get_access_token()->get_secret())
		
		$method = "presentations/$id";
		$type = Videojuicer_Request::DELETE;
		$response_class = "Videojuicer_Presentation_Delete_Response";
		$exception_class = "Videojuicer_Presentation_Delete_Exception";
		$permission = Videojuicer_Permission::WRITE_USER;

		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $token_value, $token_secret);
		
		return Videojuicer::execute_call($request);
		
	}
	
}
?>