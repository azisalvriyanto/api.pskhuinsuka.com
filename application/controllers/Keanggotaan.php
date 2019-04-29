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
        if (
			$method === "GET"
			&& !empty($periode) && is_string($periode) === TRUE
		) {
			$response = $this->M_Keanggotaan->daftar($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function lihat($periode, $username)
	{
		$method	 	= $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($periode) && is_string($periode) === TRUE
			&& !empty($username) && is_string($username) === TRUE
		) {
			$response = $this->M_Keanggotaan->lihat($username);
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
			&& is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("periode")) && is_string($this->input->post("periode")) === TRUE
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($this->input->post("password")) && is_string($this->input->post("password")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("divisi")) && is_numeric($this->input->post("divisi")) === TRUE
			&& !empty($this->input->post("jabatan")) && is_numeric($this->input->post("jabatan")) === TRUE
			&& !empty($this->input->post("email")) && is_string($this->input->post("email")) === TRUE
		) {
			if (!empty($_FILES["foto"])) {
				$foto = $_FILES["foto"];
			} else {
				$foto = "";
			}

			$response = $this->M_Keanggotaan->tambah(
				$this->input->post("keterangan"),
				$this->input->post("periode"),
				$this->input->post("username"),
				md5($this->input->post("password")),
                $foto,
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

    public function perbarui()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("periode")) && is_string($this->input->post("periode")) === TRUE
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($_FILES["foto"])
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("divisi")) && is_numeric($this->input->post("divisi")) === TRUE
			&& !empty($this->input->post("jabatan")) && is_numeric($this->input->post("jabatan")) === TRUE
			&& !empty($this->input->post("email")) && is_string($this->input->post("email")) === TRUE
		) {
			$response = $this->M_Keanggotaan->perbarui(
				$this->input->post("keterangan"),
				$this->input->post("periode"),
				$this->input->post("username"),
                $_FILES["foto"],
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
		if (
			$method === "GET"
			&& !empty($username) && is_string($username) === TRUE
		) {
			$response = $this->M_Keanggotaan->hapus($username);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
	
	public function username()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("username_lama")) && is_string($this->input->post("username_lama")) === TRUE
			&& !empty($this->input->post("username_baru")) && is_string($this->input->post("username_baru")) === TRUE
		
		) {
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
        if (
			$method === "POST"
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($this->input->post("password")) && is_string($this->input->post("password")) === TRUE
		) {
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