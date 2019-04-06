<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Organisasi extends CI_Model {
    public function lihat($periode)
    {
        $query = $this->db->select("*")->from("organisasi")->where("organisasi_periode", $periode)->get();
        if ($query->num_rows() > 0) {
            $query = $query->row();
            return array(
                "status" => 200,
                "keterangan" => array(
                    "periode" => $query->organisasi_periode,
                    "nama_lengkap" => $query->organisasi_nama_lengkap,
                    "nama_pendek" => $query->organisasi_nama_pendek,
                    "visi" => $query->organisasi_visi,
                    "misi" => $query->organisasi_misi,
                    "deskripsi" => $query->organisasi_deskripsi,
                    "tentang" => $query->organisasi_tentang,
                    "sejarah" => $query->organisasi_sejarah,
                    "kontak" => array(
                        "alamat" => $query->organisasi_alamat,
                        "email" => $query->organisasi_email,
                        "telepon" => $query->organisasi_telepon,
                        "facebook" => $query->organisasi_facebook,
                        "twitter" => $query->organisasi_twitter,
                        "instagram" => $query->organisasi_instagram,
                        "youtube" => $query->organisasi_youtube,
                        "peta" => $query->organisasi_peta
                    )
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Profil organisasi tidak ditemukan."
            );
        }
    }

    public function perbarui(
        $periode,
        $nama_lengkap,
        $nama_pendek,
        $visi,
        $misi,
        $deskripsi,
        $tentang,
        $sejarah,
        $alamat,
        $email,
        $telepon,
        $facebook,
        $twitter,
        $instagram,
        $youtube,
        $peta
    ) {
        $query = $this->db->where("organisasi_periode", $periode)->update("organisasi",
            array(
                "organisasi_periode" => $periode,
                "organisasi_nama_lengkap" => $nama_lengkap,
                "organisasi_nama_pendek" => $nama_pendek,
                "organisasi_visi" => $visi,
                "organisasi_misi" => $misi,
                "organisasi_deskripsi" => $deskripsi,
                "organisasi_tentang" => $tentang,
                "organisasi_sejarah" => $sejarah,
                "organisasi_alamat" => $alamat,
                "organisasi_email" => $email,
                "organisasi_telepon" => $telepon,
                "organisasi_facebook" => $facebook,
                "organisasi_twitter" => $twitter,
                "organisasi_instagram" => $instagram,
                "organisasi_youtube" => $youtube,
                "organisasi_peta" => $peta
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Profil organisasi berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Profil organisasi gagal diperbarui."
            );
        }
    }
}