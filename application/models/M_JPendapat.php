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
        $this->db->trans_begin();
        $this->db->where("jpendapat_id", 1)->update("jpendapat",
            array(
                "jpendapat_nama" => $nama_1,
                "jpendapat_jabatan" => $jabatan_1,
                "jpendapat_pendapat" => $pendapat_1,
            )
        );
        $this->db->where("jpendapat_id", 2)->update("jpendapat",
            array(
                "jpendapat_nama" => $nama_2,
                "jpendapat_jabatan" => $jabatan_2,
                "jpendapat_pendapat" => $pendapat_2,
            )
        );
        $this->db->where("jpendapat_id", 3)->update("jpendapat",
            array(
                "jpendapat_nama" => $nama_3,
                "jpendapat_jabatan" => $jabatan_3,
                "jpendapat_pendapat" => $pendapat_3,
            )
        );

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();

            return array(
                "status" => 200,
                "keterangan" => "Jejak pendapat berhasil diperbarui."
            );
        } else {
            $this->db->trans_rollback();

            return array(
                "status" => 204,
                "keterangan" => "Jejak pendapat gagal diperbarui."
            );
        }
    }
}