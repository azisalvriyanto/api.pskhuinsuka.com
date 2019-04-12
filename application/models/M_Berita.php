<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Berita extends CI_Model {
    public function tambah(
        $keterangan,
		$penerbit,
		$judul,
		$isi
    ) {
        $query = $this->db->insert("berita",
            array(
                "berita_keterangan" => $keterangan,
                "berita_penerbit" => $penerbit,
                "berita_judul" => $judul,
                "berita_isi" => $isi
            )
        );
        if (!empty($query)) {
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
		$isi
    ) {
        $query = $this->db->where("berita_id", $id)->update("berita",
            array(
                "berita_keterangan" => $keterangan,
                "berita_judul" => $judul,
                "berita_isi" => $isi
            )
        );
        if (!empty($query)) {
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