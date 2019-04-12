<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Pengaturan extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
    }

    public function hapus($periode)
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($periode) && is_string($periode)
		) {
            $response   = $this->M_Pengaturan->hapus($periode);

			json_output(200, $response);
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function renew()
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("periode_sekarang")) && is_string($this->input->post("periode_sekarang")) === TRUE
			&& !empty($this->input->post("tahun_awal")) && is_numeric($this->input->post("tahun_awal")) === TRUE
			&& !empty($this->input->post("tahun_akhir")) && is_numeric($this->input->post("tahun_akhir")) === TRUE
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($this->input->post("password")) && is_string($this->input->post("password")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("email")) && is_string($this->input->post("email")) === TRUE
		) {
            $periode_baru	= $this->input->post("tahun_awal")."-".$this->input->post("tahun_akhir");
            $response   	= $this->M_Pengaturan->renew(
				@str_replace("/", "-", $this->input->post("periode_sekarang")),
                $periode_baru,
                $this->input->post("username"),
                md5($this->input->post("password")),
                $this->input->post("nama"),
                $this->input->post("email"),
                $this->input->post("telepon"),
                $this->input->post("motto"),

            );

			json_output(200, $response);
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
}
