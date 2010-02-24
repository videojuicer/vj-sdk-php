<?php
/**
 * Holds the properties required to make a request to the api
 *
 */
class Videojuicer_Request {
	
	const GET = "get";
	const POST = "post";
	const PUT = "put";
	const DELETE = "delete";
	
	
	private $method;
	private $type;
	private $permission;
	private $response_class;
	private $exception_class;
	private $protocol = "http";
	private $vars = array();	// Associative array of variable to pass in url or form data
	private $upload_file_path = false;
	private $authorized = false;
	private $token = null;
	private $token_secret = null;
	private $use_extension = true;
	
	private $oembed = false;
	private $oembed_maxwidth = null;
	private $oembed_maxheight = null;
	private $oembed_format = "xml";
	private $oembed_embed_attributes = array();
	private $oembed_flashvar_attributes = array();
	
	private $api_version;
	private $seed_name;
	
	
	public function __construct($method, $type, $permission, $response_class, $exception_class) {
		$this->method = $method;
		$this->type = $type;
		$this->permission = $permission;
		$this->response_class = $response_class;
		$this->exception_class = $exception_class;
	}
	
	
	
	public function get_method() {
		return $this->method;
	}
	
	public function get_type() {
		return $this->type;
	}

	public function get_permission() {
		return $this->permission;
	}
	
	public function get_response_class() {
		return $this->response_class;
	}
	
	public function get_exception_class() {
		return $this->exception_class;
	}

	
	
	
	
	
	/**
	 * Set the ptotocol to use when making the request, e.g. http, https
	 *
	 * @param string $protocol
	 */
	public function set_protocol($protocol) {
		$this->protocol = $protocol;
	}
	
	
	/**
	 * Get the protocol to use for the request
	 *
	 * @return string
	 */
	public function get_protocol() {
		return $this->protocol;
	}
	
	
	/**
	 * Store the variables to be passed to the request as GET parameters if GET request, otherwise as POST parameters
	 *
	 * @param array $vars Associative array of the key/value variables
	 */
	public function set_vars($vars) {
		if (is_array($vars)) {
			$this->vars = $vars;
			
		} else throw new Videojuicer_Request_Exception(__METHOD__ . ": parameter 1 must be an array");
	}
	
	
	/**
	 * Get the variable list to be passed to the request
	 *
	 * @return array Associative array of the key/value variables
	 */
	public function get_vars() {
		return $this->vars;
	}
	
	
	public function set_upload_file_path($file) {
		$this->upload_file_path = $file;
	}
	
	
	public function get_upload_file_path() {
		return $this->upload_file_path;
	}

	
	public function set_seed_name($name) {
		$this->seed_name = $name;
	}
	
	public function get_seed_name() {
		return $this->seed_name;
	}
	
	public function set_api_version($version) {
		$this->api_version = $version;
	}
	
	public function get_api_version() {
		return $this->api_version;
	}
	
	/**
	 * Set whether this should be made as a signed, authorized request and optionally specify the token used to sign the request
	 *
	 * @param boolean $is_authorized
	 * @param string $token
	 */
	public function set_authorized($is_authorized = false, $token = null, $token_secret = null) {
		$this->authorized = $is_authorized;
		$this->token = $token;
		$this->token_secret = $token_secret;
	}
	
	/**
	 * Get whether or not this should be an authorized request
	 *
	 * @return boolean
	 */
	public function is_authorized() {
		return $this->authorized;
	}
	
	
	/**
	 * Set whether or not this should be made as an OEmbed request
	 *
	 * @param boolean $bool
	 * @param int $maxwidth The max width of the presentation
	 * @param int $maxheight The max height of the presentation
	 */
	public function set_oembed($bool, $maxwidth = null, $maxheight = null, $format = "xml", $embed_attributes, $flashvar_attributes) {
		$this->oembed = $bool;
		$this->oembed_maxwidth = $maxwidth;
		$this->oembed_maxheight = $maxheight;
		$this->oembed_format = $format;
		$this->oembed_embed_attributes = $embed_attributes;
		$this->oembed_flashvar_attributes = $flashvar_attributes;
	}
	
	
	/*
	 * Get whether or not this should be made as an OEmbed request
	 *
	 * @return boolean
	 */
	public function is_oembed() {
		return $this->oembed;
	}
	
	
	/**
	 * Get the max width of the presentation in the OEmbed call
	 *
	 * @return int
	 */
	public function get_oembed_maxwidth() {
		return $this->oembed_maxwidth;
	}
	
	
	/**
	 * Get the format the oembed request should be returned as
	 *
	 * @return string
	 */
	public function get_oembed_format() {
		return $this->oembed_format;
	}
	
	
	/**
	 * Get the max height of the presentation in the OEmbed call
	 *
	 * @return int
	 */
	public function get_oembed_maxheight() {
		return $this->oembed_maxheight;
	}
	
	
	/**
	 * Get the associative array of embed attributes to appear in the returned <embed> html
	 * 
	 * @return array
	 */
	public function get_oembed_embed_attributes() {
		return $this->oembed_embed_attributes;
	}
	
	
	/**
	 * Get the associative array of f;ashvars attributes to appear in the returned <object> html
	 * 
	 * @return array
	 */
	public function get_oembed_flashvar_attributes() {
		return $this->oembed_flashvar_attributes;
	}
	
	
	/**
	 * Get the token to use during a signed request
	 *
	 * @return string
	 */
	public function get_token() {
		return $this->token;
	}
	
	public function get_token_secret() {
		return $this->token_secret;
	}
	
	
	/**
	 * Get the request type which will work on all servers, converts PUT and DELETE to POST calls
	 * NB: _method of the correct type will need passing in if this is used
	 */
	public function get_safe_type() {
		
		// If it is a PUT or DELETE, return POST
		if (in_array($this->get_type(), array(self::PUT, self::DELETE))) {
			return self::POST;
			
		// Else just return whatever it is
		} else {
			return $this->get_type();
		}
	}
	
	
	
	public function use_extension($val = null) {
		if (is_null($val)) {
			return $this->use_extension;
		} else {
			$this->use_extension = (boolean) $val;
		}
	}
	
	
	
	/**
	 * Wrap each of the variables in into an array with the name $wrapper_name
	 *
	 * @param string $wrapper_name The name of the array to wrap the variables inside
	 * @return array
	 */
	public static function wrap_vars($vars, $wrapper_name) {
		$wrapped_vars = array();
		foreach ($vars as $k => $v) {
			$wrapped_vars[$wrapper_name . "[$k]"] = $v;
		}
		
		return $wrapped_vars;
	}
}
?>