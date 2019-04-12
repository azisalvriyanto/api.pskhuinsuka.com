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
			&& !empty($this->input->post("nama_panjang")) && is_string($this->input->post("nama_panjang")) === TRUE
			&& !empty($this->input->post("nama_pendek")) && is_string($this->input->post("nama_pendek")) === TRUE
        ) {
            $response	= $this->M_Organisasi->perbarui(
                $this->input->post("periode"),
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

    public function logo()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "POST"
            && !empty($this->input->post("logo_periode")) && is_string($this->input->post("logo_periode"))
            && !empty($_FILES["logo_file"])
        ) {
            $config["upload_path"] = "../pskhuinsuka.com/assets/gambar/organisasi";
            $config["allowed_types"] = "jpg|jpeg|png";
            $config["encrypt_name"] = TRUE;
            $this->load->library("upload", $config);
            if (!$this->upload->do_upload("logo_file")) {
                $response = array(
                    "status" => 403,
                    "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                );
            } else {
                $data       = $this->upload->data();
                @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/".$this->input->post("logo_periode")."_logo.png");

                $response = array(
                    "status" => 200,
                    "keterangan" => "Logo berhasil diperbarui."
                );
            }

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}