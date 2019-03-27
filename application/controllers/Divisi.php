<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Divisi extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

  	public function daftar()
	{
		$method = $_SERVER["REQUEST_METHOD"];
    	if ($method === "GET") {
			$response = $this->M_Divisi->daftar();
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

	public function lihat($divisi)
	{
		$method = $_SERVER["REQUEST_METHOD"];
		if ($method === "GET") {
				$response = $this->M_Divisi->lihat($divisi);
				json_output(200, $response);
		} else {
				json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

	public function jabatan($divisi)
	{
		$method = $_SERVER["REQUEST_METHOD"];
		if ($method === "GET") {
				$response = $this->M_Divisi->jabatan($divisi);
				json_output(200, $response);
		} else {
				json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
}