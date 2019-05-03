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

    public function unggah($nama)
    {
        $config["upload_path"] = $this->M_Pengaturan->directory()."/assets/gambar/jejakpendapat";
        $config["allowed_types"] = "jpg|jpeg|png";
        $config["encrypt_name"] = TRUE;
        $this->load->library("upload", $config);
        if (!$this->upload->do_upload($nama."_foto")) {
            return array(
                "status" => 403,
                "keterangan" => "Foto ".$nama.", ".@str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
            );
        } else {
            @rename($config["upload_path"]."/".$this->upload->data()["file_name"], $config["upload_path"]."/".$nama.".png");
            @unlink($config["upload_path"]."/".$this->upload->data()["file_name"]);

            return array(
                "status" => 200,
                "keterangan" => "Foto ".$nama." berhasil diunggah."
            );

        }
    }

    public function perbarui(
        $nama_1,
        $foto_1,
        $jabatan_1,
        $pendapat_1,
        $nama_2,
        $foto_2,
        $jabatan_2,
        $pendapat_2,
        $nama_3,
        $foto_3,
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

            $foto_status = "";
            if(!empty($foto_1) && !empty($foto_1["name"])) {
                $foto_unggah = $this->M_JPendapat->unggah("1");
                if ($foto_unggah["status"] !== 200) {
                    return $foto_unggah;
                } else {
                    $foto_status .= "1;";
                }
            }

            if(!empty($foto_2) && !empty($foto_2["name"])) {
                $foto_unggah = $this->M_JPendapat->unggah("2");
                if ($foto_unggah["status"] !== 200) {
                    return $foto_unggah;
                } else {
                    $foto_status .= "2;";
                }
            }

            if(!empty($foto_3) && !empty($foto_3["name"])) {
                $foto_unggah = $this->M_JPendapat->unggah("3");
                if ($foto_unggah["status"] !== 200) {
                    return $foto_unggah;
                } else {
                    $foto_status .= "3;";
                }
            }

            return array(
                "status" => 200,
                "keterangan" => "Jejak pendapat berhasil diperbarui".($foto_status ? " (".$foto_status.")" : "")."."
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