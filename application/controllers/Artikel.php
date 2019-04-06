<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Artikel extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function tambah()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("keterangan")) && is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("penerbit"))
			&& !empty($this->input->post("judul"))
		) {
			$response = $this->M_Artikel->tambah(
				$this->input->post("keterangan"),
				$this->input->post("penerbit"),
				$this->input->post("judul"),
				$this->input->post("isi")
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
			&& !empty($this->input->post("keterangan")) && is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("judul"))
		) {
			$response = $this->M_Artikel->perbarui(
				$this->input->post("id"),
				$this->input->post("keterangan"),
				$this->input->post("judul"),
				$this->input->post("isi")
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
			&& !empty($id)
			&& is_numeric($id) === TRUE
		) {
			$response = $this->M_Artikel->hapus($id);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}