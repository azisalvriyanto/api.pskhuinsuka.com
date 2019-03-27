<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Otentikasi extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

	public function masuk() {
		$method = $_SERVER["REQUEST_METHOD"];
        if ($method === "POST") {
			$username = $this->input->post("username");
			$password = $this->input->post("password");

            $response		= $this->M_Otentikasi->masuk($username, $password);
			json_output(200, $response);
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

	public function keluar() {
		$method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET") {
			$username = $this->input->post("username");
			if ($this->session->unset_userdata("username")) {
                json_output(200, array("status" => 200, "keterangan" => "Sesi berhasil dikeluarkan."));
            } else {
                json_output(200, array("status" => 204, "keterangan" => "Sesi gagal dikeluarkan."));
            }
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
        
	}
}
