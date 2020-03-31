<?php

/**
 * BaseController short summary.
 *
 * BaseController description.
 *
 * @version 1.0
 * @author 79523
 */
namespace Controllers;

class Controller
{
	static private $folder = 'resources/view/';

	static public function render($template, $data = array()) {
		include (self::$folder."layout.php");
	}
}
