<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Galeri extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function lihat($periode)
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($periode)
			&& is_numeric($periode) === TRUE
		) {
            $response = $this->M_Galeri->lihat($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad request."));
		}
    }

    public function simpan()
	{
        $method = $_SERVER["REQUEST_METHOD"];
		if (
			$method === "POST"
			&& !empty($this->input->post("periode")) && is_numeric($this->input->post("periode")) === TRUE
		) {
			$response = $this->M_Galeri->perbarui(
				$this->input->post("periode"),
				$this->input->post("instagram")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}