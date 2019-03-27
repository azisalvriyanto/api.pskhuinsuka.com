<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Galat extends CI_Controller {
	public function _404() 
	{
		json_output(200, array("status" => 404, "keterangan" => "Not Found."));
	}
}