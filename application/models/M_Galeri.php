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
        $instagram,
        $landscape,
        $portrait
    ) {
        $query = $this->db->where("galeri_periode", $periode)->update("galeri",
            array(
                "galeri_instagram" => $instagram
            )
        );
        if (!empty($query)) {
            $foto_status = "";

            if(!empty($landscape) && !empty($landscape["name"])) {
                $foto_unggah = $this->M_Galeri->unggah($periode, "landscape");
                if ($foto_unggah["status"] !== 200) {
                    return $foto_unggah;
                } else {
                    $foto_status .= "landscape;";
                }
            }

            if(!empty($portrait) && !empty($portrait["name"])) {
                $foto_unggah = $this->M_Galeri->unggah($periode, "portrait");
                if ($foto_unggah["status"] !== 200) {
                    return $foto_unggah;
                } else {
                    $foto_status .= "portrait;";
                }
            }

            return array(
                "status" => 200,
                "keterangan" => "Galeri berhasil diperbarui".($foto_status ? " (".$foto_status.")" : "")."."
            );
        }
        else {
            return array(
                "status" => 403,
                "keterangan" => "Galeri gagal diperbarui"
            );
        }
    }

    public function unggah($periode, $nama)
    {
        $config["upload_path"] = "../pskhuinsuka.com/assets/gambar/organisasi";
        $config["allowed_types"] = "jpg|jpeg|png";
        $config["encrypt_name"] = TRUE;
        $this->load->library("upload", $config);
        if (!$this->upload->do_upload($nama)) {
            return array(
                "status" => 403,
                "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
            );
        } else {
            @rename($config["upload_path"]."/".$this->upload->data()["file_name"], $config["upload_path"]."/".$periode."_".$nama.".png");
            @unlink($config["upload_path"]."/".$this->upload->data()["file_name"]);

            return array(
                "status" => 200,
                "keterangan" => "Gambar berhasil diunggah."
            );
        }
    }
}