<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Kegiatan extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function daftar($periode)
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($periode) && is_string($periode) === TRUE
		) {
			$response = $this->M_Kegiatan->daftar($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function lihat($periode, $id)
	{
		$method	 	= $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($periode) && is_string($periode) === TRUE
			&& !empty($id) && is_numeric($id) === TRUE
		) {
			$response = $this->M_Kegiatan->lihat($periode, $id);
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
			&& !empty($this->input->post("periode")) && is_string($this->input->post("periode")) === TRUE
			&& !empty($this->input->post("tanggal")) && is_string($this->input->post("tanggal")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
		) {
			$response = $this->M_Kegiatan->tambah(
				$this->input->post("periode"),
				date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post("tanggal")))),
				$this->input->post("nama"),
				$this->input->post("keterangan")
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
			&& !empty($this->input->post("periode")) && is_string($this->input->post("periode")) === TRUE
			&& !empty($this->input->post("tanggal")) && is_string($this->input->post("tanggal")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
		) {
			$response = $this->M_Kegiatan->perbarui(
				$this->input->post("id"),
				$this->input->post("periode"),
				date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post("tanggal")))),
				$this->input->post("nama"),
				$this->input->post("keterangan")
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
			$response = $this->M_Kegiatan->hapus($id);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}