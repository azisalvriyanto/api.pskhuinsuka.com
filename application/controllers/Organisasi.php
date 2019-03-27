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
        if ($method === "GET" && !empty($this->uri->segment(2)) && is_string($this->uri->segment(2)) === TRUE) {
            $response = $this->M_Organisasi->lihat($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad request."));
		}
    }

    public function simpan()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "POST") {
            $parameter	= json_decode(file_get_contents("php://input"), TRUE);
            $query = $this->db->select("organisasi_periode")->from("organisasi")->where("organisasi_periode", $this->input->post("periode"))->get();
            if ($query->num_rows() > 0) {
                $response	= $this->M_Organisasi->perbarui(
                    $query->row()->organisasi_periode,
                    $this->input->post("nama_lengkap"),
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
            } else {
                $response	= $this->M_Organisasi->tambah(
                    $this->input->post("periode"),
                    $this->input->post("nama_lengkap"),
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
            }

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function hapus($periode)
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET" && !empty($this->uri->segment(2)) && is_numeric($this->uri->segment(2)) == TRUE) {
            $response = $this->M_Organisasi->hapus($periode);
            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
}