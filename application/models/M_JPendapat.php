<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_JPendapat extends CI_Model {
    public function daftar()
    {
        $query = $this->db->select("*")->from("jpendapat")->get();
        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar jejak pendapat tidak ditemukan."
            );
        }
    }


    public function perbarui(
        $nama_1,
        $jabatan_1,
        $pendapat_1,
        $nama_2,
        $jabatan_2,
        $pendapat_2,
        $nama_3,
        $jabatan_3,
        $pendapat_3
    )
    {
        $query1 = $this->db->where("jpendapat_id", 1)->update("jpendapat",
            array(
                "jpendapat_nama" => $nama_1,
                "jpendapat_jabatan" => $jabatan_1,
                "jpendapat_pendapat" => $pendapat_1,
            )
        );

        $query2 = $this->db->where("jpendapat_id", 2)->update("jpendapat",
            array(
                "jpendapat_nama" => $nama_2,
                "jpendapat_jabatan" => $jabatan_2,
                "jpendapat_pendapat" => $pendapat_2,
            )
        );

        $query3 = $this->db->where("jpendapat_id", 3)->update("jpendapat",
            array(
                "jpendapat_nama" => $nama_3,
                "jpendapat_jabatan" => $jabatan_3,
                "jpendapat_pendapat" => $pendapat_3,
            )
        );

        if (!empty($query1) && !empty($query2) && !empty($query3)) {
            return array(
                "status" => 200,
                "keterangan" => "Jejak pendapat berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Jejak pendapat gagal diperbarui."
            );
        }
    }
}