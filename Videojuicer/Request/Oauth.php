<?php
Videojuicer_ClassLoader::load("Videojuicer_Request");
Videojuicer_ClassLoader::load("Videojuicer_Auxil_OAuth");

class Videojuicer_Request_Oauth {
	
	
	/**
	 * Retrieve an unauthorized request token in preperation for retrieving an eccess token
	 */
	public static function get_unauthorized_request_token() {
		
		$method = "oauth/tokens";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Token_Unauthorized_Response";
		$exception_class = "Videojuicer_Token_Unauthorized_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true);
		$request->use_extension(false);
		
		return Videojuicer::execute_call($request);
		
	}
	
	
	
	
	
	/**
	 * Send the user to the authorisation page and redirect to the callback page on completion
	 * 
	 * @param string $callback_url The url to redirect the user to once they're logged in at Videojuicer
	 * @param string $unauthorized_token_value The token value to use when signning the request (optional: if no value passed, the current one is retrieved from the Videojuicer class)
	 */
	public static function get_authorize_url($callback_url, $unauthorized_token_value = null) {
		
		// If we weren't given a token to use, retrieve it from Videojuicer class
		if (is_null($unauthorized_token_value)) {
			$token = Videojuicer::get_token();
			if ($token instanceof Videojuicer_Token_Unauthorized) {
				$unauthorized_token_value = $token->get_token();
			}
		}
		
		$method = "oauth/tokens/new";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Token_Authorize_Response";
		$exception_class = "Videojuicer_Token_Authorize_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $unauthorized_token_value);
		$request->set_vars(array("oauth_callback" => $callback_url));
		$request->use_extension(false);
		
		
		// Do the logic to decide what the components of the HTTP request should be
		Videojuicer_ClassLoader::load("Videojuicer_Call_Helper");
		$helper = new Videojuicer_Call_Helper($request);
		$helper->setup_components();

		// Retrieve the values determined
		$url = $helper->get_url();
		
		return $url;
	}
	
	
	
	
	

	/**
	 * Retrieve an authorized request token in preperation for retrieving an access token
	 */
	public static function get_authorized_request_token($unauthorized_token_value = null, $unauthorized_token_secret = null) {
		
		// If we weren't given a token to use, retrieve it from Videojuicer class
		if (is_null($unauthorized_token_value) || is_null($unauthorized_token_secret)) {
			$token = Videojuicer::get_token();
			if ($token instanceof Videojuicer_Token_Unauthorized) {
				$unauthorized_token_value = $token->get_token();
				$unauthorized_token_secret = $token->get_secret();
			}
		}
		
		
		$method = "oauth/tokens";
		$type = Videojuicer_Request::GET;
		$response_class = "Videojuicer_Token_Authorized_Response";
		$exception_class = "Videojuicer_Token_Authorized_Exception";
		$permission = Videojuicer_Permission::NONE;
		
		$request = new Videojuicer_Request($method, $type, $permission, $response_class, $exception_class);
		$request->set_authorized(true, $unauthorized_token_value, $unauthorized_token_secret);
		$request->use_extension(false);
		
		
		return Videojuicer::execute_call($request);
	}
	
}
?>