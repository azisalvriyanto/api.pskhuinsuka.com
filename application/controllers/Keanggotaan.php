<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Keanggotaan extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function daftar($periode)
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET" && !empty($periode) && is_string($periode) === TRUE) {
			$response = $this->M_Keanggotaan->daftar($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function lihat($periode, $username)
	{
		$method	 	= $_SERVER["REQUEST_METHOD"];
        if ($method === "GET" && !empty($periode) && is_string($periode) === TRUE && !empty($username) && is_string($username) === TRUE) {
			$response = $this->M_Keanggotaan->lihat($username);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function tambah()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "POST") {
			$response = $this->M_Keanggotaan->tambah(
				$this->input->post("keterangan"),
				$this->input->post("periode"),
				$this->input->post("nama"),
				$this->input->post("username"),
				md5($this->input->post("password")),
				$this->input->post("divisi"),
				$this->input->post("jabatan"),
				$this->input->post("email"),
				$this->input->post("telepon"),
				$this->input->post("motto")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function perbarui()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "POST") {
			$response = $this->M_Keanggotaan->perbarui(
				$this->input->post("keterangan"),
				$this->input->post("username"),
				$this->input->post("nama"),
				$this->input->post("divisi"),
				$this->input->post("jabatan"),
				$this->input->post("email"),
				$this->input->post("telepon"),
				$this->input->post("motto")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function hapus($username)
    {
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET" && !empty($username) && is_string($username) === TRUE) {
			$response = $this->M_Keanggotaan->hapus($username);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
	
	public function username()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "POST") {
			$response = $this->M_Keanggotaan->username(
				$this->input->post("username_lama"),
				$this->input->post("username_baru")
			);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
	
	public function password()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "POST") {
			$response = $this->M_Keanggotaan->password(
				$this->input->post("username"),
				md5($this->input->post("password"))
			);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}