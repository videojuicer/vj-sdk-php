<?php

if (!defined("VIDEOJUICER_ABS_PATH")) define("VIDEOJUICER_ABS_PATH", dirname(__FILE__) . "/..");

/**
 * Locates and includes class files
 */
class Videojuicer_ClassLoader
{
  /**
   * A list of files already located
   * @var array
   */
  protected static $located = array();
  
  /**
   * Load a new class into memory
   * @param string The name of the class, case SenSItivE
   */
  public static function load($name)
  {
    if (in_array($name, self::$located) || class_exists($name, false) || interface_exists($name, false))
      return;
    
    require_once (VIDEOJUICER_ABS_PATH . "/" . str_replace("_", "/", $name) . ".php");
    self::$located[] = $name;
  }
}
?>