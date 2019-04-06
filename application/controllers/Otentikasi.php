<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Otentikasi extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

	public function masuk() {
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("username")) && is_string($this->input->post("username"))
            && !empty($this->input->post("password")) && is_string($this->input->post("password"))
		) {
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
			if ($this->session->unset_userdata("username") === NULL) {
                json_output(200, array("status" => 200, "keterangan" => "Anda berhasil keluar dari sesi masuk."));
            } else {
                json_output(200, array("status" => 204, "keterangan" => "Anda gagal keluar dari sesi masuk."));
            }
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
        
	}
}
