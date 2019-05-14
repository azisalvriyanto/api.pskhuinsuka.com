<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Keuangan extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}
	
	public function bulan_daftar($periode)
	{
		$method = $_SERVER["REQUEST_METHOD"];
		if (
			$method === "GET"
			&& !empty($periode) && is_string($periode) === TRUE
		) {
			$response = $this->M_Keuangan->bulan_daftar($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function lihat($id)
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($id) && is_numeric($id) === TRUE
		) {
			$response = $this->M_Keuangan->lihat($id);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function daftar($periode, $bulan="")
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($periode) && is_string($periode) === TRUE
		) {
			$response = $this->M_Keuangan->daftar($periode, $bulan);
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
            && !empty($this->input->post("periode")) && is_string($this->input->post("periode"))
			&& !empty($this->input->post("tanggal")) && is_string($this->input->post("tanggal")) === TRUE
			&& !empty($this->input->post("judul")) && is_string($this->input->post("judul")) === TRUE
			&& is_numeric($this->input->post("jumlah")) === TRUE
			&& !empty($this->input->post("keterangan")) && is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("nominal")) && is_numeric($this->input->post("nominal")) === TRUE
        ) {
            $response	= $this->M_Keuangan->tambah(
                $this->input->post("periode"),
                date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post("tanggal")))),
                $this->input->post("judul"),
                $this->input->post("jumlah"),
                $this->input->post("keterangan"),
                $this->input->post("nominal"),
				$_FILES["gambar"]
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
            && !empty($this->input->post("id")) && is_numeric($this->input->post("id"))
			&& !empty($this->input->post("tanggal")) && is_string($this->input->post("tanggal")) === TRUE
			&& !empty($this->input->post("judul")) && is_string($this->input->post("judul")) === TRUE
			&& is_numeric($this->input->post("jumlah")) === TRUE
			&& !empty($this->input->post("keterangan")) && is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("nominal")) && is_numeric($this->input->post("nominal")) === TRUE
        ) {
            $response	= $this->M_Keuangan->perbarui(
                $this->input->post("id"),
                date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post("tanggal")))),
                $this->input->post("judul"),
                $this->input->post("jumlah"),
                $this->input->post("keterangan"),
                $this->input->post("nominal"),
				$_FILES["gambar"]
            );

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

	public function hapus($id)
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET" && !empty($id) && is_string($id) === TRUE) {
			$response = $this->M_Keuangan->hapus($id);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
}