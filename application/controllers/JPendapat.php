<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class JPendapat extends CI_Controller {
    public function daftar()
		{
			$method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET") {
          $response = $this->M_JPendapat->daftar();
					json_output(200, $response);
			} else {
				json_output(200, array("status" => 400, "keterangan" => "Bad request."));
			}
    }

    public function simpan()
    {
				$method = $_SERVER["REQUEST_METHOD"];	
        if ($method === "POST") {
					$response = $this->M_JPendapat->perbarui(
						$this->input->post("1_nama"),
						$this->input->post("1_jabatan"),
						$this->input->post("1_pendapat"),
						$this->input->post("2_nama"),
						$this->input->post("2_jabatan"),
						$this->input->post("2_pendapat"),
						$this->input->post("3_nama"),
						$this->input->post("3_jabatan"),
						$this->input->post("3_pendapat"),
					);

			json_output(200, $response);
			} else {
				json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
			}
    }
}