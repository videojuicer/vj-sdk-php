<?php
class Videojuicer_Response_Format {
	
	/** Available response formats **/
	const XML = 1;
	const YAML = 2;
	const JSON = 3;
	

	/**
	 * Get the extension to be be used for the provided response format
	 *
	 * @param int $format The ResponseFormat id
	 * @return string The extension, throws VideojuicerResponseFormatException on invalid format provided
	 */
	public static function get_extension($format) {
		switch ($format) {
			case self::XML: return "xml"; break;
			case self::YAML: return "yaml"; break;
			case self::JSON: return "json"; break;
			default: throw new Videojuicer_Response_Format_Exception("Invalid format provided");
		}
	}
	
	
	/**
	 * Get the list of available response format types
	 *
	 * @return array
	 */
	public static function get_available_formats() {
		return array(self::XMl, self::YAML, self::JSON);
	}
	
	
	/**
	 * Return whether a given response format is valid
	 *
	 * @param int $format
	 * @return boolean
	 */
	public function is_valid($format) {
		$available_formats = self::get_available_formats();
		return in_array($format, $available_formats);
	}
}
?>