<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Berkas extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
    }

    public function daftar()
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
		) {
			$response = $this->M_Berkas->daftar();
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function lihat($id)
	{
		$method	 	= $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($id) && is_numeric($id) === TRUE
		) {
			$response = $this->M_Berkas->lihat( $id);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function tambah()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("tautan")) && is_string($this->input->post("tautan")) === TRUE
		) {
			$response = $this->M_Berkas->tambah(
				$this->input->post("nama"),
				$this->input->post("tautan")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function perbarui()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("id")) && is_numeric($this->input->post("id")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("tautan")) && is_string($this->input->post("tautan")) === TRUE
		) {
			$response = $this->M_Berkas->perbarui(
				$this->input->post("id"),
				$this->input->post("nama"),
				$this->input->post("tautan")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function hapus($id)
    {
        $method = $_SERVER["REQUEST_METHOD"];
		if (
			$method === "GET"
			&& !empty($id) && is_numeric($id) === TRUE
		) {
			$response = $this->M_Berkas->hapus($id);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}