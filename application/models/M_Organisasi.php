<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Organisasi extends CI_Model {
    public function periode_daftar()
    {
        $periode = $this->db->select("organisasi_periode")->from("organisasi")->get();
        if ($periode->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($periode->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar periode tidak ditemukan."
            );
        }
    }

    public function periode_terakhir()
    {
        $periode = $this->db->select("organisasi_periode")->from("organisasi")->order_by("organisasi_periode","DESC")->limit(1)->get();
        if ($periode->num_rows() > 0) {
            $periode = $periode->row();
            return array(
                "status" => 200,
                "keterangan" => $periode->organisasi_periode
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar periode tidak ditemukan."
            );
        }
    }

    public function lihat($periode)
    {
        $query = $this->db->select("*")->from("organisasi")->where("organisasi_periode", $periode)->get();
        if ($query->num_rows() > 0) {
            $query = $query->row();

            if (@is_file($this->M_Pengaturan->directory()."/assets/gambar/organisasi/".$query->organisasi_periode."_logo.png")) {
                $logo	= "assets/gambar/organisasi/".$query->organisasi_periode."_logo.png";
            } else {
                $logo	= "assets/gambar/organisasi/_standar_logo.png";
            }

            return array(
                "status" => 200,
                "keterangan" => array(
                    "periode" => $query->organisasi_periode,
                    "logo" => $logo,
                    "nama_panjang" => $query->organisasi_nama_panjang,
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
        $logo,
        $nama_panjang,
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
                "organisasi_nama_panjang" => $nama_panjang,
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
            if(!empty($logo) && !empty($logo["name"])) {
                $config["upload_path"] = $this->M_Pengaturan->directory()."/assets/gambar/organisasi";
                $config["allowed_types"] = "jpg|jpeg|png";
                $config["encrypt_name"] = TRUE;
                $this->load->library("upload", $config);
                if (!$this->upload->do_upload("logo")) {
                    return array(
                        "status" => 403,
                        "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                    );
                } else {
                    $data       = $this->upload->data();
                    @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/".$periode."_logo.png");

                }
            }

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