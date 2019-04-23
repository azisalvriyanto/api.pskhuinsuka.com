<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Kegiatan extends CI_Model {
    public function daftar($periode)
    {
        $query = $this->db->select("*")->from("kegiatan")
        ->where("kegiatan_periode", $periode)
        ->order_by("kegiatan_tanggal","ASC")
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
                "keterangan" => "Daftar kegiatan pada periode \"".$periode."\" tidak ditemukan."
            );
        }
    }

    public function lihat($periode, $id)
    {
        $query = $this->db->select("*")->from("kegiatan")
        ->where("kegiatan_periode", $periode)
        ->where("kegiatan_id", $id)
        ->get();

        if ($query->num_rows() > 0) {
            $query  = $query->row();

            return array(
                "status" => 200,
                "keterangan" => array(
                    "id" => $query->kegiatan_id,
                    "periode" => $query->kegiatan_periode,
                    "tanggal" => date("d/m/Y", strtotime($query->kegiatan_tanggal)),
                    "nama" => $query->kegiatan_nama,
                    "keterangan" => $query->kegiatan_keterangan
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Kegiatan tidak ditemukan."
            );
        }
    }

    public function tambah(
        $periode,
        $tanggal,
        $nama,
        $keterangan
    ) {
        $query = $this->db->insert("kegiatan",
            array(
                "kegiatan_periode" => $periode,
                "kegiatan_tanggal" => $tanggal,
                "kegiatan_nama" => $nama,
                "kegiatan_keterangan" => $keterangan
            )
        );

        if ($query) {
            return array(
                "status" => 200,
                "keterangan" => "Kegiatan \"".$nama."\" berhasil ditambahkan."
            );
        } else {
            return array(
                "status" => 204,
                "keterangan" => "Kegiatan \"".$nama."\" gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $id,
        $periode,
        $tanggal,
        $nama,
        $keterangan
    ) {
        $query = $this->db->where("kegiatan_id", $id)->where("kegiatan_periode", $periode)->update("kegiatan",
            array(
                "kegiatan_tanggal" => $tanggal,
                "kegiatan_nama" => $nama,
                "kegiatan_keterangan" => $keterangan
            )
        );

        if ($query) {
            return array(
                "status" => 200,
                "keterangan" => "Kegiatan \"".$nama."\" berhasil ditambahkan."
            );
        } else {
            return array(
                "status" => 204,
                "keterangan" => "Kegiatan \"".$nama."\" gagal ditambahkan."
            );
        }
    }

    public function hapus($id)
    {
        $query = $this->db->where("kegiatan_id", $id)->delete("kegiatan");
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Kegiatan berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Kegiatan gagal dihapus."
            );
        }
    }
}