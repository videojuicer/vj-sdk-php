<?php
require_once dirname(__FILE__) . "/Videojuicer/ClassLoader.php";
Videojuicer_ClassLoader::load("Videojuicer_Response_Format");
Videojuicer_ClassLoader::load("Videojuicer_Call_Helper");
Videojuicer_ClassLoader::load("Videojuicer_Debug");

class Videojuicer {
	
	private static $seed_name = "YOUR-SEED-NAME";
	
	// API key & secret goes here
	private static $api_key = "YOUR-API-KEY";
	private static $api_secret = "YOUR-API-SECRET";
	
	
	private static $user = null;				// The currently logged in user object
	private static $request_token = null;		// The unauthorized request token object
	private static $access_token = null;		// The access token granting this user access object
	
	private static $api_version = 1;
	private static $response_format = Videojuicer_Response_Format::XML;
	
	
	private static $debug_level = Videojuicer_Debug::NONE;
	
	
	
	const VJ_REST_URL    = 'api.videojuicer.com/';
	
	
	
	/**
	 * Set the response format to use for requests
	 *
	 * @param int $format
	 */
	public static function set_response_format($format) {
		if (Videojuicer_Response_Format::is_valid($format)) {
			self::$response_format = $format;
			
		} else {
			Videojuicer_ClassLoader::load("Videojuicer_Response_Format_Exception");
			throw new Videojuicer_Response_Format_Exception("Invalid format provided");
		}
	}
	
	
	
	/**
	 * Get the extension to use for the api response format
	 *
	 * @return string
	 */
	public static function get_response_format_extension() {
		return Videojuicer_Response_Format::get_extension(self::$response_format);
	}
	
	
	
	
	public static function get_seed_name() {
		return self::$seed_name;
	}
	
	
	public static function get_api_key() {
		return self::$api_key;
	}
	
	
	public static function get_api_secret() {
		return self::$api_secret;
	}
	
	
	public static function get_api_version() {
		return self::$api_version;
	}
	
	
	
	
	public static function execute_call(Videojuicer_Request $req) {

		// Do the logic to decide what the components of the HTTP request should be
		$helper = new Videojuicer_Call_Helper($req);
		$helper->setup_components();

		// Retrieve the values determined
		$url = $helper->get_url();
		$post_vars = $helper->get_post_vars();
		$type = $req->get_safe_type();
		$file = $req->get_upload_file_path();
			
		// Get the resulting xml(or other data)
		$data = self::execute_call_curl($url, $req->get_type(), $post_vars, $file);
		
		// Convert the xml to the target class
		$response_class = $req->get_response_class();
		Videojuicer_ClassLoader::load($response_class);
		
		$result = new $response_class($data);
		// Return the result
		return $result;
	
	}
	
	
	
	/**
	 * Perform the retrieval using CURL
	 *
	 * @return SimpleXMLElement
	 */
	private static function execute_call_curl($url, $type = "get", $post_vars = array(), $file = false) {
		
		// Determine how to make the request
		switch ($type) {
			// Make a POST request for POST, PUT and DELETE (not all servers support PUT and DELETE)
			case Videojuicer_Request::POST:
			case Videojuicer_Request::PUT:
			case Videojuicer_Request::DELETE:
				$make_post = true;
				break;
			case Videojuicer_Request::GET:
			default:
				$make_post = false;
				break;
		}
		
		if (Videojuicer::debug_level() >= Videojuicer_Debug::ALL) {
        	echo "URL: $url<br />\n";
		}
        
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Tell cURL if we're making a post request
        if ($make_post) {
        	
        	if (Videojuicer::debug_level() >= Videojuicer_Debug::ALL) {
        		echo "POST VARS BEFORE HTTP_BUILD_QUERY: " . print_r($post_vars, true);
        	}
        	
			// If there is a file o be included, add it to the array and make the post data an array so cURL multiparts the transfer
		    if ($file) {
		    	$post_vars["asset[file]"] = "@$file";
		    	$post_data = $post_vars;
		    	curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
		    	
		    // Else doesn't need to be multipart so build post data into a string
		    } else {
		    	$post_data = http_build_query($post_vars);
		    }

        	if (Videojuicer::debug_level() >= Videojuicer_Debug::ALL) {
        		echo "POST DATA: $post_data<br />\n";
        	}
        	
        	curl_setopt($ch, CURLOPT_VERBOSE, 1);

        	curl_setopt($ch, CURLOPT_POST, 1);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			
        }
        
        

        // Make the call
        $data = curl_exec($ch);
        if(curl_errno($ch)) {
        	
        	Videojuicer_ClassLoader::load("Videojuicer_Request_Exception");
            throw new Videojuicer_Request_Exception('execute_call_curl error: ' . curl_error($ch), curl_errno($ch));
        } else {
            curl_close($ch);
            
            if (!$data || strlen(trim($data)) < 2) {
            	
            	Videojuicer_ClassLoader::load("Videojuicer_Request_Exception");
                throw new Videojuicer_Request_Exception('API request error: No result returned.', 1);
            }

            return $data;
        }
	}
	
	
	/**
	 * Get the currently logged in user
	 *
	 * @return unknown
	 */
	public static function get_user() {
		return self::$user;
	}
	
	
	/**
	 * Get the unauthorized access token used by this user
	 *
	 * @return Videojuicer_Token_Unauthorized
	 */
	public static function get_request_token() {
		return self::$request_token;
	}
	
	
	/**
	 * Store the request token
	 *
	 * @param Videojuicer_Token_Unauthorized $token
	 */
	public static function set_request_token(Videojuicer_Token_Unauthorized $token) {
		self::$request_token = $token;
	}
	
	
	/**
	 * Get the access token used by this user
	 *
	 * @return Videojuicer_Token_Authorized
	 */
	public static function get_access_token() {
		return self::$access_token;
	}
	
	
	public static function set_access_token(Videojuicer_Token_Authorized $token) {
		self::$access_token = $token;
	}
	
	
	/**
	 * Get the token to use in requests, uses the access token if available else uses the request token (which may or may not be present)
	 *
	 * @return Videojuicer_Token_Abstract
	 */
	public static function get_token() {
		
		if (self::$access_token) return self::$access_token;
		else return self::$request_token;
		
	}
	
	
	
	/**
	 * Get the debugging level to use
	 *
	 * @return int
	 */
	public static function debug_level() {
		return self::$debug_level;
	}
}
?>