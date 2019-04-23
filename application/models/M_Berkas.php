<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Berkas extends CI_Model {
    public function daftar()
    {
        $query = $this->db->select("*")->from("berkas")->order_by("berkas_nama","ASC")->get();

        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar berkas pada periode \"".$periode."\" tidak ditemukan."
            );
        }
    }

    public function lihat($id)
    {
        $query = $this->db->select("*")->from("berkas")->where("berkas_id", $id)->get();

        if ($query->num_rows() > 0) {
            $query  = $query->row();

            return array(
                "status" => 200,
                "keterangan" => array(
                    "id" => $query->berkas_id,
                    "nama" => $query->berkas_nama,
                    "tautan" => $query->berkas_tautan
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "berkas tidak ditemukan."
            );
        }
    }

    public function tambah(
        $nama,
        $tautan
    ) {
        $query = $this->db->insert("berkas",
            array(
                "berkas_nama" => $nama,
                "berkas_tautan" => $tautan
            )
        );

        if ($query) {
            return array(
                "status" => 200,
                "keterangan" => "berkas \"".$nama."\" berhasil ditambahkan."
            );
        } else {
            return array(
                "status" => 204,
                "keterangan" => "berkas \"".$nama."\" gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $id,
        $nama,
        $tautan
    ) {
        $query = $this->db->where("berkas_id", $id)->update("berkas",
            array(
                "berkas_nama" => $nama,
                "berkas_tautan" => $tautan
            )
        );

        if ($query) {
            return array(
                "status" => 200,
                "keterangan" => "berkas \"".$nama."\" berhasil ditambahkan."
            );
        } else {
            return array(
                "status" => 204,
                "keterangan" => "berkas \"".$nama."\" gagal ditambahkan."
            );
        }
    }

    public function hapus($id)
    {
        $query = $this->db->where("berkas_id", $id)->delete("berkas");
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "berkas berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "berkas gagal dihapus."
            );
        }
    }
}