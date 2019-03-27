<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Divisi extends CI_Model {
    public function daftar()
    {
        $query = $this->db->select("*")->from("divisi")->get();

        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar divisi tidak ditemukan."
            );
        }
    }

    public function lihat($divisi)
    {
        $query = $this->db->select("*")->from("divisi")->where("divisi_id", $jabatan)->get();
        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => array (
                    "id" => $query->divisi_id,
                    "keterangan" => $query->divisi_keterangan,
                    "penjelasan" => $query->divisi_penjelasan
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Divisi tidak ditemukan."
            );
        }
    }

    public function jabatan($divisi)
    {
        $query = $this->db->select("*")->from("jabatan_x")->where("jabatan_x_divisi", $divisi)
        ->join("divisi", "divisi.divisi_id=jabatan_x.jabatan_x_divisi")
        ->join("jabatan", "jabatan.jabatan_id=jabatan_x.jabatan_x_jabatan")
        ->get();
        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar jabatan pada divisi \"".$divisi."\" tidak ditemukan."
            );
        }
    }
}