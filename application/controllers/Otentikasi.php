<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Otentikasi extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

	public function masuk() {
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("username")) && is_string($this->input->post("username"))
            && !empty($this->input->post("password")) && is_string($this->input->post("password"))
		) {
			$username = $this->input->post("username");
			$password = $this->input->post("password");

            $response		= $this->M_Otentikasi->masuk($username, $password);
			json_output(200, $response);
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

	public function keluar() {
		$method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET") {
			if ($this->session->unset_userdata("username") === NULL) {
                json_output(200, array("status" => 200, "keterangan" => "Anda berhasil keluar dari sesi masuk."));
            } else {
                json_output(200, array("status" => 204, "keterangan" => "Anda gagal keluar dari sesi masuk."));
            }
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
        
	}

	public function pesan() {
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama"))
            && !empty($this->input->post("email")) && is_string($this->input->post("email"))
            && !empty($this->input->post("judul")) && is_string($this->input->post("judul"))
            && !empty($this->input->post("pesan")) && is_string($this->input->post("pesan"))
		) {
			$config = [
				"mailtype"  => "html",
				"charset"   => "utf-8",
				"protocol"  => "smtp",
				"smtp_host" => "ssl://smtp.gmail.com",
				"smtp_user" => "aalvriyanto@gmail.com",
				"smtp_pass" => "`al-vri``",
				"smtp_port" => 465,
				"crlf"      => "\r\n",
				"newline"   => "\r\n"
			];

			$this->load->library("email", $config);
			$this->email->from($this->input->post("email"), $this->input->post("nama"));
			$this->email->to("sandakala.id@gmail.com");
			$this->email->subject($this->input->post("judul"));
			$this->email->message($this->input->post("pesan"));

			$to 		= "aalvriyanto@gmail.com";
			$headers 	= "From: ".$this->input->post("nama")." <".$this->input->post("email").">";
			$subject	= $this->input->post("judul");
			$message	= $this->input->post("pesan");

			if ($this->email->send() || @mail($to, $subject, $message, $headers)) {
				$response = array(
					"status" => 200,
					"keterangan" => "Mohon tunggu balasan dari kami."
				);
			} else {
				$response = array(
					"status" => 403,
					"keterangan" => "Terjadi kesalahan dalam pengiriman pesan."
				);
			}

			json_output(200, $response);
		}
		else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
        
	}
}
