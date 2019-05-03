<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Artikel extends CI_Model {
    public function tambah(
        $keterangan,
		$penerbit,
		$judul,
		$isi,
		$gambar
    ) {
        $query = $this->db->insert("artikel",
            array(
                "artikel_keterangan" => $keterangan,
                "artikel_penerbit" => $penerbit,
                "artikel_judul" => $judul,
                "artikel_isi" => $isi
            )
        );
        if (!empty($query)) {
            if(!empty($gambar) && !empty($gambar["name"])) {
                $config["upload_path"] = $this->M_Pengaturan->directory()."/assets/artikel";
                $config["allowed_types"] = "jpg|jpeg|png";
                $config["encrypt_name"] = TRUE;
                $this->load->library("upload", $config);
                if (!$this->upload->do_upload("gambar")) {
                    return array(
                        "status" => 403,
                        "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                    );
                } else {
                    $data       = $this->upload->data();
                    @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/".$this->db->insert_id().".png");
                }
            }

            return array(
                "status" => 200,
                "keterangan" => array(
                    "id" => $this->db->insert_id()
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Artikel gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $id,
        $keterangan,
		$judul,
		$isi,
		$gambar
    ) {
        $query = $this->db->where("artikel_id", $id)->update("artikel",
            array(
                "artikel_keterangan" => $keterangan,
                "artikel_judul" => $judul,
                "artikel_isi" => $isi
            )
        );
        if (!empty($query)) {
            if(!empty($gambar) && !empty($gambar["name"])) {
                $config["upload_path"] = $this->M_Pengaturan->directory()."/assets/artikel";
                $config["allowed_types"] = "jpg|jpeg|png";
                $config["encrypt_name"] = TRUE;
                $this->load->library("upload", $config);
                if (!$this->upload->do_upload("gambar")) {
                    return array(
                        "status" => 403,
                        "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                    );
                } else {
                    $data       = $this->upload->data();
                    @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/".$id.".png");
                }
            }

            return array(
                "status" => 200,
                "keterangan" => "Artikel berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Artikel gagal diperbarui."
            );
        }
    }

    public function hapus($id)
    {
        $query = $this->db->where("artikel_id", $id)->delete("artikel");
        if (!empty($query)) {
            @unlink($this->M_Pengaturan->directory()."/assets/artikel/".$id.".png");

            return array(
                "status" => 200,
                "keterangan" => "Artikel berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Artikel gagal dihapus."
            );
        }
    }
}