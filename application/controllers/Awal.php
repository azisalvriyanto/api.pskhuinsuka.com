<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Awal extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
    }
}