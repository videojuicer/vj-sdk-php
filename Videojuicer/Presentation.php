<?php
Videojuicer_ClassLoader::load("Videojuicer_Entity");

/**
 * Holds a Presentation dataset
 *
 */
class Videojuicer_Presentation extends Videojuicer_Entity {
	
	private $publish_from;
	private $publish_until;
	private $author;
	private $callback_url;
	private $user_id;
	private $updated_at;
	private $image_asset_id;
	private $title;
	private $id;
	private $state;
	private $disclosure;
	private $created_at;
	private $abstract;
	
	public function __construct($data) {
		
		$this->publish_from 	= (string) $data->publish_from;
		$this->publish_until 	= (string) $data->publish_until;
		$this->author 			= (string) $data->author;
		$this->callback_url 	= (string) $data->callback_url;
		$this->user_id 			= (string) $data->user_id;
		$this->updated_at 		= (string) $data->updated_at;
		$this->image_asset_id 	= (string) $data->image_asset_id;
		$this->title 			= (string) $data->title;
		$this->id 				= (string) $data->id;
		$this->state 			= (string) $data->state;
		$this->disclosure 		= (string) $data->disclosure;
		$this->created_at		= (string) $data->created_at;
		$this->abstract 		= (string) $data->abstract;
		
	}
	
	
	
	
	
	
	
	
	/**
	 * Find the Presentation matching the id specified
	 *
	 * @param int $id
	 * 
	 * @return Videojuicer_Presentation_Response
	 */
	public static function find($id) {
		$method = "presentations";
		$method .= "/$id";
		
		$response = Videojuicer::execute_call($method);
		return $response;
	}
	
	
	
	/**
	 * Find all Presentation objects that meet the conditionsv provided
	 *
	 * @param array $conditions 
	 * @param int $related_to
	 * 
	 * @return Videojuicer_Presentation_List_Response
	 */
	public static function find_all($conditions = array(), $related_to = null) {
		$method = "presentations";
		
		// If we want presentations related to another presentation
		if (is_numeric($related_to)) $method .= "/$related_to/related_by_tag";
		
		// Modify the conditions to be specific to presentations
		foreach ($conditions as $key => $val) {
			$conditions["presentation[$key]"] = $val;
		}
		
		// Make the call
		$response = Videojuicer::execute_call($method, $conditions);
		return $response;
	}
	
	
	
	
	
	
	
	
	
	
	
	public function get_title() {
		return $this->title;
	}
	public function get_image_asset_id() {
		return $this->image_asset_id;
	}
	
	
	public function get_created_at() {
		return $this->created_at;
	}
}
?>