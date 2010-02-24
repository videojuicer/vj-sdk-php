<?php
Videojuicer_ClassLoader::load("Videojuicer_Token_Unauthorized_Exception");
Videojuicer_ClassLoader::load("Videojuicer_Token_Abstract");

class Videojuicer_Token_Unauthorized extends Videojuicer_Token_Abstract {
	
	private $token;
	private $secret;
	
	
	/**
	 * Create an unauthorized token object from the oauth encodd string in the form
	 * oauth_token=thetoken&oauth_token_secret=thesecret
	 *
	 * @param string $url_encoded oauth_token=thetoken&oauth_token_secret=thesecret
	 */
	public function __construct($url_encoded) {
		
		// Extract the token/secret
		$components = $this->extract_components($url_encoded);
		
		// If we managed to extract a token/secret
		if (isset($components["token"]) && isset($components["secret"])) {
		
			echo "Setting secret: " . $components["secret"];
			
			// Store the data
			$this->set_token($components["token"]);
			$this->set_secret($components["secret"]);
			
		} else throw new Videojuicer_Token_Unauthorized_Exception("Response format invalid");
	}
	
	
	
	public function set_token($token) {
		$this->token = $token;
	}
	
	public function get_token() {
		return $this->token;
	}
	
	
	public function set_secret($secret) {
		$this->secret = $secret;
	}
	
	public function get_secret() {
		return $this->secret;
	}
	
}
?>