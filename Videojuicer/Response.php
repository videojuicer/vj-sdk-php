<?php
class Videojuicer_Response {
	
	private $status = false;
	private $xml;
	
	
	public function __construct($xml = false) {
		
		// If xml was returned
		if ($xml) {
		
            // Parse status
            $this->set_status(true);
            $this->xml = $xml;
		}
	}
	
	
	/**
	 * Get the status of the response
	 * 
	 * @return boolean
	 */
	public function get_status() {
		return $this->status;
	}
	
	/**
	 * Get the xml of the response
	 * 
	 * @return xml
	 */
	public function get_response() {
		return $this->xml;
	}
	
	
	/**
	 * Set the status of the response
	 *
	 * @param boolean $status
	 */
	public function set_status($status) {
		$this->status = $status;
	}
	
}
?>