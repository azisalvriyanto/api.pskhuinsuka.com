<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Berita extends CI_Model {
    public function tambah(
        $keterangan,
		$penerbit,
		$judul,
		$isi,
		$gambar,
        $kegiatan
    ) {
        if (!empty($kegiatan) && $kegiatan !== "undefined" && is_numeric($kegiatan)) {
            $query = $this->db->insert("berita",
                array(
                    "berita_keterangan" => $keterangan,
                    "berita_penerbit" => $penerbit,
                    "berita_judul" => $judul,
                    "berita_isi" => $isi,
                    "berita_kegiatan" => $kegiatan
                )
            );
        } else {
            $query = $this->db->insert("berita",
                array(
                    "berita_keterangan" => $keterangan,
                    "berita_penerbit" => $penerbit,
                    "berita_judul" => $judul,
                    "berita_isi" => $isi,
                    "berita_kegiatan" => "0"
                )
            );
        }

        if (!empty($query)) {
            if(!empty($gambar) && !empty($gambar["name"])) {
                $config["upload_path"] = $this->M_Pengaturan->directory()."/assets/berita";
                $config["allowed_types"] = "jpg|jpeg|png|JPG|JPEG|PNG";
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
                "keterangan" => "Berita gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $id,
        $keterangan,
		$judul,
		$isi,
        $gambar,
        $kegiatan
    ) {
        if (!empty($kegiatan) && $kegiatan !== "undefined" && is_numeric($kegiatan)) {
            $query = $this->db->where("berita_id", $id)->update("berita",
                array(
                    "berita_keterangan" => $keterangan,
                    "berita_judul" => $judul,
                    "berita_isi" => $isi,
                    "berita_kegiatan" => $kegiatan
                )
            );
        } else {
            $query = $this->db->where("berita_id", $id)->update("berita",
                array(
                    "berita_keterangan" => $keterangan,
                    "berita_judul" => $judul,
                    "berita_isi" => $isi,
                    "berita_kegiatan" => "0"
                )
            );
        }
        
        if (!empty($query)) {
            if(!empty($gambar) && !empty($gambar["name"])) {
                $config["upload_path"] = $this->M_Pengaturan->directory()."/assets/berita";
                $config["allowed_types"] = "jpg|jpeg|png|JPG|JPEG|PNG";
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
                "keterangan" => "Berita berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Berita gagal diperbarui."
            );
        }
    }

    public function hapus($id)
    {
        $query = $this->db->where("berita_id", $id)->delete("berita");
        if (!empty($query)) {
            @unlink($this->M_Pengaturan->directory()."/assets/berita/".$id.".png");

            return array(
                "status" => 200,
                "keterangan" => "Berita berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Berita gagal dihapus."
            );
        }
    }
}