<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Permission");

class Videojuicer_Request_Presentation {
	
	
	/**
	 * Get the presentation with the provided ID
	 *
	 * @param int $id
	 * @return Videojuicer_Presentation_Response
	 */
	public function find($id) {

		$method = "presentations/$id";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Presentation_Response";
		$exception_class = "Videojuicer_Presentation_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		return Videojuicer::execute_call($request);
	}
	
	
	
	/**
	 * Get all presentations, optinally meeting the required criteria
	 *
	 * @param array $criteria Find only presentations which meet the criteria provided
	 * @return Videojuicer_Presentation_List_Response
	 */
	public function find_all($criteria = array()) {

		$method = "presentations";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Presentation_List_Response";
		$exception_class = "Videojuicer_Presentation_List_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		
		// Wrap each of the criteria with a presentation key
		$converted_criteria = array();
		foreach ($criteria as $k => $v) {
			$converted_criteria["presentation[$k]"] = $v;
		}
		$request->set_vars($converted_criteria);
		
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
	public function find_all_related_to($id, $criteria = array()) {

		$method = "presentations/$id/related_by_tag";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Presentation_Response";
		$exception_class = "Videojuicer_Presentation_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		return Videojuicer::execute_call($request);
	}
}
?>