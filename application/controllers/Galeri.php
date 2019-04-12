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
			&& is_string($periode) === TRUE
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
			&& !empty($this->input->post("periode")) && is_string($this->input->post("periode")) === TRUE
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

    public function landscape()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "POST"
            && !empty($this->input->post("landscape_periode")) && is_string($this->input->post("landscape_periode"))
            && !empty($_FILES["landscape_file"])
        ) {
            $config["upload_path"] = "../pskhuinsuka.com/assets/gambar/organisasi";
            $config["allowed_types"] = "jpg|jpeg|png";
            $config["encrypt_name"] = TRUE;
            $this->load->library("upload", $config);
            if (!$this->upload->do_upload("landscape_file")) {
                $response = array(
                    "status" => 403,
                    "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                );
            } else {
                $data       = $this->upload->data();
                @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/".$this->input->post("landscape_periode")."_landscape.png");

                $response = array(
                    "status" => 200,
                    "keterangan" => "Foto landscape berhasil diperbarui."
                );
            }

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function portrait()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "POST"
            && !empty($this->input->post("portrait_periode")) && is_string($this->input->post("portrait_periode"))
            && !empty($_FILES["portrait_file"])
        ) { 
            $config["upload_path"] = "../pskhuinsuka.com/assets/gambar/organisasi";
            $config["allowed_types"] = "jpg|jpeg|png";
            $config["encrypt_name"] = TRUE;
            $this->load->library("upload", $config);
            if (!$this->upload->do_upload("portrait_file")) {
                $response = array(
                    "status" => 403,
                    "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                );
            } else {
                $data       = $this->upload->data();
                @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/".$this->input->post("portrait_periode")."_portrait.png");

                $response = array(
                    "status" => 200,
                    "keterangan" => "Foto portrait diperbarui."
                );
            }

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}