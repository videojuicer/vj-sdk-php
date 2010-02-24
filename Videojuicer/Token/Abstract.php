<?php
abstract class Videojuicer_Token_Abstract {
	
	public abstract function __construct($data);
	
	public abstract function set_token($token);
	public abstract function get_token();
	
	public abstract function set_secret($secret);
	public abstract function get_secret();
	
	
	
	/**
	 * Extract the tokey/secret components from the data received
	 *
	 * @param string $data
	 * @return array Associative array with keys "token" and "secret" if the data was found
	 */
	protected function extract_components($data) {
		
		$components = array();
		
		// Extract the token/secret
		$parts = explode("&", $data);
		
		foreach ($parts as $part) {
			list($var, $value) = explode("=", $part, 2);
			
			if ($var === "oauth_token") $components["token"] = urldecode($value);
			else if ($var === "oauth_token_secret") $components["secret"] = urldecode($value);
		}
		
		
		return $components;
	}
}
?>