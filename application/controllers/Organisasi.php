<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Organisasi extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function lihat($periode)
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "GET"
            && !empty($periode) && is_string($periode)
        ) {
            $response = $this->M_Organisasi->lihat($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad request."));
		}
    }

    public function perbarui()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "POST"
            && !empty($this->input->post("periode")) && is_string($this->input->post("periode"))
			&& !empty($_FILES["logo"])
			&& !empty($this->input->post("nama_panjang")) && is_string($this->input->post("nama_panjang")) === TRUE
			&& !empty($this->input->post("nama_pendek")) && is_string($this->input->post("nama_pendek")) === TRUE
        ) {
            $response	= $this->M_Organisasi->perbarui(
                $this->input->post("periode"),
                $_FILES["logo"],
                $this->input->post("nama_panjang"),
                $this->input->post("nama_pendek"),
                $this->input->post("visi"),
                $this->input->post("misi"),
                $this->input->post("deskripsi"),
                $this->input->post("tentang"),
                $this->input->post("sejarah"),
                $this->input->post("alamat"),
                $this->input->post("email"),
                $this->input->post("telepon"),
                $this->input->post("facebook"),
                $this->input->post("twitter"),
                $this->input->post("instagram"),
                $this->input->post("youtube"),
                $this->input->post("peta")
            );

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}