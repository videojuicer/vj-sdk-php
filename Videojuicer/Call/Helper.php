<?php
class Videojuicer_Call_Helper {
	
	private $request;
	
	private $post_vars;
	private $url;
	
	public function __construct(Videojuicer_Request $request) {
		$this->request = $request;
	}
	
	
	
	
	
	public function setup_components() {
		
		// Retrieve the request
		$req = $this->get_request();
		
		
		// Used in all requests
		$seed_name = Videojuicer::get_seed_name();
		$api_version = Videojuicer::get_api_version();

		// Create the basic url
		$url = $req->get_protocol() . "://" . Videojuicer::VJ_REST_URL . $req->get_method();
		
		// Setup the mandatory vars which must be passed with all requests
		$mandatory_vars = array("seed_name" => $seed_name,
								"api_version" => $api_version);
		
		
		// Now decide what url parameters and post parameter should be based on the submission type
		$get_vars = array();
		$post_vars = array();

		switch ($req->get_type()) {
			
			// GET
			case Videojuicer_Request::GET: default:
				
				$get_vars = array_merge($get_vars, $req->get_vars(), $mandatory_vars);
				$url_retrieval_method = "to_url";
				break;
				
			// POST
			case Videojuicer_Request::POST:

				$post_vars = array_merge($post_vars, $req->get_vars(), $mandatory_vars);
				$url_retrieval_method = "get_normalized_http_url";
				break;
				
			// PUT and DELETE
			case Videojuicer_Request::PUT:
			case Videojuicer_Request::DELETE:
				$post_vars["_method"] = strtoupper($req->get_type());
				$post_vars = array_merge($post_vars, $req->get_vars(), $mandatory_vars);
				$url_retrieval_method = "get_normalized_http_url";
				break;
		}
		
		
		
		// Determine whether to sign it
		if ($req->is_authorized()) {
			
			// If we're appending the extension, do so
			if ($req->use_extension()) {
				$url .= "." . Videojuicer::get_response_format_extension();
			}
			
			if (sizeof($get_vars)) {
				$url .= "?" . http_build_query($get_vars);
			}
			
			$token_value = $req->get_token();	// Retrieve a token (if any) assigned to this user
			$token_secret = $req->get_token_secret();
			
			$token = new OAuthToken($token_value, $token_secret);
			
			// Determine the custom parameters which need signing
			$sign_params = (sizeof($post_vars)) ? $post_vars : $get_vars;
			
			// Create a consumer we're receiving a token for
			$consumer = new OAuthConsumer(Videojuicer::get_api_key(), Videojuicer::get_api_secret());
			
			// Generate the request object
			$oauth_req = OAuthRequest::from_consumer_and_token($consumer, $token, strtoupper($req->get_safe_type()), $url, $sign_params);
			
			// Use SHA encryption
			$hmac_method = new OAuthSignatureMethod_HMAC_SHA1();

			// Sign the request
			$oauth_req->sign_request($hmac_method, $consumer, $token);
			
			$post_vars = $oauth_req->get_parameters();
			uksort($post_vars, 'strcmp');
			
			if (Videojuicer::debug_level() >= Videojuicer_Debug::ALL) {
				echo "POST VARS: " . print_r($post_vars, true) . "<br />\n";
			}
			
			
			$url = $oauth_req->$url_retrieval_method();
			
			
		// It it is a plain call
		} else {
			
			$url .= "." . Videojuicer::get_response_format_extension();

			if (sizeof($get_vars)) {
				$url .= "?" . http_build_query($get_vars);
			}
			
			// If this request need to be made as an OEmbed request we need to construct a new url using the previous one as a parameter
			if ($req->is_oembed()) {
				
				$oembed_vars = $mandatory_vars;
				$oembed_vars["maxwidth"] = $req->get_oembed_maxwidth();
				$oembed_vars["maxheight"] = $req->get_oembed_maxheight();
				$oembed_vars["format"] = $req->get_oembed_format();
				$oembed_vars["embed"] = $req->get_oembed_embed_attributes();
				$oembed_vars["flashvars"] = $req->get_oembed_flashvar_attributes();
				
				$oembed_vars["url"] = $url;
				
				$url = $req->get_protocol() . "://" . Videojuicer::VJ_REST_URL . "oembed?" . http_build_query($oembed_vars);
			}
		}
		
		// Store the results
		$this->url = $url;
		$this->post_vars = $post_vars;
	}
	
	
	/**
	 * Get the request we're working with
	 *
	 * @return Videojuicer_Request
	 */
	private function get_request() {
		return $this->request;
	}
	
	
	
	/**
	 * Get the url which was constructed previously
	 *
	 * @return string
	 */
	public function get_url() {
		return $this->url;
	}
	
	/**
	 * Get the post vars
	 *
	 * @return array
	 */
	public function get_post_vars() {
		return $this->post_vars;
	}
	
}
?>