<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Galeri extends CI_Model {
    public function lihat($periode)
    {
        $query = $this->db->select("*")->from("galeri")->where("galeri_periode", $periode)->get();
        if ($query->num_rows() > 0) {
            $query  = $query->row();

            return array(
                "status" => 200,
                "keterangan" => array(
                    "periode" => $query->galeri_periode,
                    "instagram" => $query->galeri_instagram
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Galeri tidak ditemukan."
            );
        }
    }

    public function perbarui(
        $periode,
        $instagram
    ) {
        $query = $this->db->where("galeri_periode", $periode)->update("galeri",
            array(
                "galeri_instagram" => $instagram
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Galeri berhasil diperbarui"
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Galeri gagal diperbarui"
            );
        }
    }
}