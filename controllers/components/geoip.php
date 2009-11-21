<?php
/**
 * GeoIPComponent for CakePHP 1.2.x.x (geoip.php).
 *
 * Copyright (C) Wayne Khan 2009
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
 */
class GeoIPComponent extends Object {

	var $controller = null; // controller reference
	var $gi = null;

	// callbacks

	/**
	* Called before Controller::beforeFilter().
	*
	* @param array $settings is used to pass all parameters to the component,
	* and has the following possible keys by default -- all of which are
	* optional:
	*
	* array(
	*	'sourceFile' => "geoip.inc", // path to source file
	*	'resourceFile' => "GeoIP.dat" // path to resource file
	* )
	*
	* An example $components definition in your controller would look like:
	*
	* var $components = array("Geoip" => array(
	*	"sourceFile" => "foo",
	*	"resourceFile" => "bar")
	* );
	*
	* The default solution is to place geoip.inc in app/vendors, and GeoIP.dat
	* in app/webroot.
	*
	* If an error is encountered like "Fatal error: Call to undefined
	* function geoip_open()", it indicates that the 'sourceFile'
	* value is incorrect.
	*
	* If an error is encountered like "Warning: [function.fopen]: failed to
	* open stream: No such file or directory", it indicates that the
	* 'resourceFile' value is incorrect.
	*/
	function initialize(&$controller, $settings = array())
	{
		$this->controller =& $controller; // saving the controller reference for later use

		// set some $defaults

		$default = array(
			"sourceFile" => "geoip.inc", // e.g. app/vendors/geoip.inc
			"resourceFile" => WWW_ROOT . "GeoIP.dat" // e.g. app/webroot/GeoIP.dat
		);
		$options = Set::merge($default, $settings); // ... but prefer controller $settings

		App::import("Vendor", "GeoIP", array("file" => $options["sourceFile"]));
		$this->gi = geoip_open($options["resourceFile"], GEOIP_STANDARD);
	}

	/**
	* Called after Controller::beforeFilter().
	*/
	function startup(&$controller)
	{

	}

	/**
	* Called after Controller::beforeRender().
	*/
	function beforeRender(&$controller)
	{

	}

	/**
	* Called after Controller::render().
	*/
	function shutdown(&$controller)
	{
		@geoip_close($gi); // cleanup
	}

	/**
	* Called before Controller::redirect().
	*/
	function beforeRedirect(&$controller, $url, $status = null, $exit = true)
	{

	}

	// methods

	function countryCode($address = null)
	{
		return geoip_country_code_by_addr($this->gi, $address);
	}

	function countryName($address = null)
	{
		return geoip_country_name_by_addr($this->gi, $address);
	}
}
?>